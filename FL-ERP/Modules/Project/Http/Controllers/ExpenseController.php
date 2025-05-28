<?php

namespace Modules\Project\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Project\Entities\Project;
use Modules\Project\Entities\ProjectExpense;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use App\Utils\BusinessUtil;
use App\Utils\ModuleUtil;
use App\Utils\ProductUtil;
use App\Utils\TransactionUtil;





class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    /**
     * All Utils instance.
     */
    protected $transactionUtil;

    protected $productUtil;

    protected $moduleUtil;

    protected $businessUtil;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TransactionUtil $transactionUtil, ProductUtil $productUtil, ModuleUtil $moduleUtil, BusinessUtil $businessUtil)
    {
        $this->transactionUtil = $transactionUtil;
        $this->productUtil = $productUtil;
        $this->moduleUtil = $moduleUtil;
        $this->businessUtil = $businessUtil;
    }

    public function index(Request $request)
    {

        $business_id = request()->session()->get('user.business_id');
        if ($request->ajax()) {


            $expenses = ProjectExpense::where('business_id', $business_id)
                ->with('project')
                ->select('project_expenses.*')
                ->orderByDesc('created_at'); // Show latest expenses first

            // Extract date range
            $date_range = $request->input('date_range');
            $start_date = $end_date = null;

            if (!empty($date_range)) {
                $date_range_array = explode('~', $date_range);
                $start_date = $this->transactionUtil->uf_date(trim($date_range_array[0]));
                $end_date = $this->transactionUtil->uf_date(trim($date_range_array[1]));
            }

            // Apply pjt_project_id filter
            if (!empty($request->pjt_project_id)) {
                $expenses->where('pjt_project_id', $request->pjt_project_id);
            }

            // Calculate total amount
            $totalAmount = $expenses->sum('amount');

            // Handle date filters
            if (!empty($start_date) && !empty($end_date)) {
                $expenses->whereBetween('created_at', [
                    Carbon::parse($start_date)->startOfDay(),
                    Carbon::parse($end_date)->endOfDay()
                ]);
            } elseif (!empty($start_date)) {
                $expenses->where('created_at', '>=', Carbon::parse($start_date)->startOfDay());
            } elseif (!empty($end_date)) {
                $expenses->where('created_at', '<=', Carbon::parse($end_date)->endOfDay());
            }

            // Filter by name
            if (!empty($request->name)) {
                $expenses->where('project_expenses.name', $request->name);
            }

            return DataTables::of($expenses)
                ->addColumn('project_name', function ($row) {
                    return $row->project ? $row->project->name : '-';
                })
                ->editColumn('amount', function ($row) {
                    $amount = $row->amount;

                    return '<span class="amount" data-orig-value="' . $amount .
                        '">' . $this->transactionUtil->num_f($amount, true) . '</span>';
                })
                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->format('Y-m-d'); // Format date
                })
                ->rawColumns(['amount', 'action']) // Ensure HTML rendering
                ->addColumn(
                    'action',
                    '<button data-href="{{action(\'Modules\Project\Http\Controllers\ExpenseController@edit\', [$id])}}" class="btn btn-xs btn-primary edit_expense_project_button">
            <i class="glyphicon glyphicon-edit"></i> @lang("messages.edit")
        </button>
        &nbsp;
        <button data-href="{{action(\'Modules\Project\Http\Controllers\ExpenseController@destroy\', [$id])}}" class="btn btn-xs btn-danger delete_expense_project_button">
            <i class="glyphicon glyphicon-trash"></i> @lang("messages.delete")
        </button>'
                )
                ->rawColumns(['amount', 'action'])
                ->with('totalAmount', $expenses->sum('amount')) // Pass total to JS
                ->make(true);


        }

        $projects = Project::where('business_id', $business_id)
            ->pluck('name', 'id');
        $names = ProjectExpense::where('business_id', $business_id)
            ->select('name')
            ->distinct()
            ->pluck('name', 'name')
            ->sort();

        return view('project::project.expenses.index')->with(compact('projects', 'names'));
    }




    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */

    public function create()
    {
        $business_id = request()->session()->get('user.business_id');

        if (!(auth()->user()->can('superadmin') || $this->moduleUtil->hasThePermissionInSubscription($business_id, 'project_module'))) {
            abort(403, 'Unauthorized action.');
        }

        $projects = Project::where('business_id', $business_id)
            ->pluck('name', 'id');
        $names = ProjectExpense::where('business_id', $business_id)
            ->select('name')
            ->distinct()
            ->pluck('name', 'name')
            ->sort();

        return view('project::project.expenses.create')->with(compact('projects', 'names'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */

    public function store(Request $request)
    {

        $request->validate([
            'pjt_project_id' => 'required',
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'remarks' => 'nullable|string',
        ]);


        try {
            $business_id = request()->session()->get('user.business_id');

            if (!(auth()->user()->can('superadmin') || $this->moduleUtil->hasThePermissionInSubscription($business_id, 'project_module'))) {
                abort(403, 'Unauthorized action.');
            }
            
            $data = ProjectExpense::create(array_merge($request->all(), ['business_id' => $business_id]));



            // event(new ExpenseCreatedOrModified($expense));

            DB::commit();

            $output = [
                'success' => 1,
                'msg' => __('project::lang.expense_created_success'),
            ];

        } catch (\Exception $e) {
            DB::rollBack();

            Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('messages.something_went_wrong'),
            ];
        }

        if (request()->ajax()) {
            return $output;
        }

        return back()->with('status', $output);



    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('project::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $business_id = request()->session()->get('user.business_id');

        if (!(auth()->user()->can('superadmin') || $this->moduleUtil->hasThePermissionInSubscription($business_id, 'project_module'))) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            $project_expense = ProjectExpense::where('business_id', $business_id)
                ->findOrFail($id);

            if (!$project_expense) {
                return response()->json(['error' => __('messages.something_went_wrong')], 404);
            }

            $projects = Project::where('business_id', $business_id)
            ->pluck('name', 'id');

            $names = ProjectExpense::where('business_id', $business_id)
                ->select('name')
                ->distinct()
                ->pluck('name', 'name')
                ->sort();


            return view('project::project.expenses.edit')->with(compact('project_expense', 'projects', 'names'));
        }
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {

        $business_id = request()->session()->get('user.business_id');


        if (request()->ajax()) {
            try {
                $input = $request->only(['pjt_project_id', 'name', 'amount', 'remarks']);

                $project_expense = ProjectExpense::where('business_id', $business_id)
                    ->findOrFail($id);
                $project_expense->pjt_project_id = $input['pjt_project_id'];
                $project_expense->name = $input['name'];
                $project_expense->amount = $input['amount'];
                $project_expense->remarks = $input['remarks'];

                $project_expense->save();

                $output = [
                    'success' => true,
                    'msg' => __('project::lang.expense_updated_success'),
                ];
            } catch (\Exception $e) {
                \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

                $output = [
                    'success' => false,
                    'msg' => __('messages.something_went_wrong'),
                ];
            }

            return $output;
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {

        if (request()->ajax()) {
            try {

                $business_id = request()->session()->get('user.business_id');

                $project_expense = ProjectExpense::where('business_id', $business_id)
                    ->findOrFail($id);
                $project_expense->delete();

                $output = [
                    'success' => true,
                    'msg' => __('project::lang.expense_deleted_success'),
                ];
            } catch (\Exception $e) {
                \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

                $output = [
                    'success' => false,
                    'msg' => __('messages.something_went_wrong'),
                ];
            }

            return $output;
        }
    }


    public function report(Request $request)
    {
        if ($request->ajax()) {
            $business_id = request()->session()->get('user.business_id');

            if (!(auth()->user()->can('superadmin') || $this->moduleUtil->hasThePermissionInSubscription($business_id, 'project_module'))) {
                abort(403, 'Unauthorized action.');
            }

            // Main query for DataTables (grouped by project)
            $query = ProjectExpense::where('project_expenses.business_id', $business_id)
                ->with('project')
                ->join('pjt_projects', 'project_expenses.pjt_project_id', '=', 'pjt_projects.id')
                ->selectRaw('project_expenses.pjt_project_id, pjt_projects.name as project_name, SUM(project_expenses.amount) as total_expense')
                ->groupBy('project_expenses.pjt_project_id', 'pjt_projects.name');

            // Calculate the total amount directly
            $allTotal = ProjectExpense::where('business_id', $business_id)->sum('amount');

            return DataTables::of($query)
                ->addIndexColumn()
                ->with('allTotal', $allTotal) // Pass the grand total to the response
                ->make(true);
        }

        return view('project::project.expenses.report');

    }

}
