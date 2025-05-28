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




class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $expenses = ProjectExpense::with('project')
                ->select('project_expenses.*')
                ->orderByDesc('created_at'); // Show latest expenses first

            // Apply filters
            if (!empty($request->project_id)) {
                $expenses->where('project_id', $request->project_id);
            }

            // Handle date filters
            if (!empty($request->start_date) && !empty($request->end_date)) {
                \Log::info('Applying date range filter', [
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date
                ]);
                $expenses->whereBetween('created_at', [
                    Carbon::parse($request->start_date)->startOfDay(),
                    Carbon::parse($request->end_date)->endOfDay()
                ]);
            } elseif (!empty($request->start_date)) {
                \Log::info('Applying start date filter', [
                    'start_date' => $request->start_date
                ]);
                $expenses->where('created_at', '>=', Carbon::parse($request->start_date)->startOfDay());
            } elseif (!empty($request->end_date)) {
                \Log::info('Applying end date filter', [
                    'end_date' => $request->end_date
                ]);
                $expenses->where('created_at', '<=', Carbon::parse($request->end_date)->endOfDay());
            }

            // Filter by name (from project_expenses.name)
            if (!empty($request->name)) {
                $expenses->where('project_expenses.name', $request->name);
            }

            return DataTables::of($expenses)
                ->addColumn('project_name', function ($row) {
                    return $row->project ? $row->project->name : '-';
                })
                ->addColumn(
                    'action',
                    '<button data-href="{{action(\'Modules\Project\Http\Controllers\ExpenseController@edit\', [$id])}}" class="btn btn-xs btn-primary edit_expense_project_button"><i class="glyphicon glyphicon-edit"></i> @lang("messages.edit")</button>
                        &nbsp;
                        <button data-href="{{action(\'Modules\Project\Http\Controllers\ExpenseController@destroy\', [$id])}}" class="btn btn-xs btn-danger delete_expense_project_button"><i class="glyphicon glyphicon-trash"></i> @lang("messages.delete")</button>
                    '
                )
                ->rawColumns(['action'])
                ->make(true);
        }

        // Fetch data for dropdowns
        $projects = Project::pluck('name', 'id'); // Get project names with IDs as keys
        $names = ProjectExpense::select('name')->distinct()->pluck('name', 'name')->sort();

        return view('project::project.expenses.index')->with(compact('projects', 'names'));
    }



    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */

    public function create()
    {

        $projects = Project::pluck('name', 'id');


        return view('project::project.expenses.create')->with(compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */

    public function store(Request $request)
    {


        $request->validate([
            'project_id' => 'required',
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'remarks' => 'nullable|string',
        ]);


        try {

            ProjectExpense::create($request->all());



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

        if (request()->ajax()) {
            $project_expense = ProjectExpense::find($id);

            if (!$project_expense) {
                return response()->json(['error' => __('messages.something_went_wrong')], 404);
            }

            $projects = Project::pluck('name', 'id');

            return view('project::project.expenses.edit')->with(compact('project_expense', 'projects'));
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

        if (request()->ajax()) {
            try {
                $input = $request->only(['project_id', 'name', 'amount', 'remarks']);

                $project_expense = ProjectExpense::findOrFail($id);
                $project_expense->project_id = $input['project_id'];
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

                $project_expense = ProjectExpense::findOrFail($id);
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
            // Main query for DataTables (grouped by project)
            $query = ProjectExpense::with('project')
                ->join('pjt_projects', 'project_expenses.project_id', '=', 'pjt_projects.id')
                ->select(
                    'project_expenses.project_id',
                    'pjt_projects.name as project_name',
                    DB::raw('SUM(project_expenses.amount) as total_expense')
                )
                ->groupBy('project_expenses.project_id', 'pjt_projects.name');

            // Separate query for calculating the allTotal (not grouped)
            $totalQuery = ProjectExpense::query();
            $allTotal = $totalQuery->sum('amount');

            return DataTables::of($query)
                ->addIndexColumn()
                ->with('allTotal', $allTotal) // Pass the grand total to the response
                ->make(true);
        }

        return view('project::project.expenses.report');
    }

}
