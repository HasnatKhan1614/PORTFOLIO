<?php

namespace Modules\Accounting\Http\Controllers;

use App\Utils\ModuleUtil;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Accounting\Entities\AccountingAccountCostCenter;
use Modules\Accounting\Utils\AccountingUtil;
use Yajra\DataTables\Facades\DataTables;

class AccountingAccountCostCenterController extends Controller
{
    /**
     * All Utils instance.
     */
    protected $util;

    /**
     * Constructor
     *
     * @param  ProductUtils  $product
     * @return void
     */
    public function __construct(Util $util, ModuleUtil $moduleUtil, AccountingUtil $accountingUtil)
    {
        $this->util = $util;
        $this->moduleUtil = $moduleUtil;
        $this->accountingUtil = $accountingUtil;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $business_id = request()->session()->get('user.business_id');
        if (
            !(auth()->user()->can('superadmin') ||
                $this->moduleUtil->hasThePermissionInSubscription($business_id, 'accounting_module')) ||
            !(auth()->user()->can('accounting.view_transfer'))
        ) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            $accounting_account_cost_center = AccountingAccountCostCenter::where('business_id', $business_id)->get();
                

            return Datatables::of($accounting_account_cost_center)
                ->addColumn(
                    'action',
                    function ($row) {
                        $html = '<div class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle btn-xs" 
                                    data-toggle="dropdown" aria-expanded="false">' .
                            __('messages.actions') .
                            '<span class="caret"></span><span class="sr-only">Toggle Dropdown
                                    </span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">';
                        if (auth()->user()->can('accounting.edit_transfer')) {
                            $html .= '<li>
                                <a href="#" data-href="' . action(
                                [\Modules\Accounting\Http\Controllers\AccountingAccountCostCenterController::class, 'edit'],
                                [$row->id]
                            ) . '" class="btn-modal" data-container="#create_transfer_modal">
                                    <i class="fas fa-edit"></i>' . __('messages.edit') . '
                                </a>
                            </li>';
                        }
                        if (auth()->user()->can('accounting.delete_transfer')) {
                            $html .= '<li>
                                    <a href="#" data-href="' . action([\Modules\Accounting\Http\Controllers\AccountingAccountCostCenterController::class, 'destroy'], [$row->id]) . '" class="delete_transfer_button">
                                        <i class="fas fa-trash" aria-hidden="true"></i>' . __('messages.delete') . '
                                    </a>
                                    </li>';
                        }

                        $html .= '</ul></div>';

                        return $html;
                    }
                )
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('accounting::cost_center.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $business_id = request()->session()->get('user.business_id');

        if (
            !(auth()->user()->can('superadmin') ||
                $this->moduleUtil->hasThePermissionInSubscription($business_id, 'accounting_module')) ||
            !(auth()->user()->can('accounting.add_transfer'))
        ) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            return view('accounting::cost_center.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $business_id = request()->session()->get('user.business_id');

        if (
            !(auth()->user()->can('superadmin') ||
                $this->moduleUtil->hasThePermissionInSubscription($business_id, 'accounting_module')) ||
            !(auth()->user()->can('accounting.add_transfer'))
        ) {
            abort(403, 'Unauthorized action.');
        }

        try {
            DB::beginTransaction();


           

            $acc_account_cost_center = new AccountingAccountCostCenter();
            $acc_account_cost_center->name = $request->get('name');
            $acc_account_cost_center->business_id = $business_id;
            $acc_account_cost_center->save();

          

            DB::commit();

            $output = [
                'success' => 1,
                'msg' => __('lang_v1.added_success'),
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('messages.something_went_wrong'),
            ];
        }

        return $output;
    }

    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return view('accounting::show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

        $business_id = request()->session()->get('user.business_id');

        if (
            !(auth()->user()->can('superadmin') ||
                $this->moduleUtil->hasThePermissionInSubscription($business_id, 'accounting_module')) ||
            !(auth()->user()->can('accounting.edit_transfer'))
        ) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            $acc_account_cost_center = AccountingAccountCostCenter::where('id', $id)
                ->where('business_id', $business_id)
                ->firstOrFail();

            return view('accounting::cost_center.edit')->with(compact('acc_account_cost_center'));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $business_id = request()->session()->get('user.business_id');

        if (
            !(auth()->user()->can('superadmin') ||
                $this->moduleUtil->hasThePermissionInSubscription($business_id, 'accounting_module')) ||
            !(auth()->user()->can('accounting.edit_transfer'))
        ) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $acc_account_cost_center = AccountingAccountCostCenter::where('id', $id)
                ->where('business_id', $business_id)->firstOrFail();


            DB::beginTransaction();
            $acc_account_cost_center->name = $request->get('name');
       
            $acc_account_cost_center->save();

            DB::commit();

            $output = [
                'success' => 1,
                'msg' => __('lang_v1.updated_success'),
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('messages.something_went_wrong'),
            ];
        }

        return $output;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $business_id = request()->session()->get('user.business_id');

        if (
            !(auth()->user()->can('superadmin') ||
                $this->moduleUtil->hasThePermissionInSubscription($business_id, 'accounting_module')) ||
            !(auth()->user()->can('accounting.delete_transfer'))
        ) {
            abort(403, 'Unauthorized action.');
        }

        $acc_account_cost_center = AccountingAccountCostCenter::where('id', $id)
            ->where('business_id', $business_id)->firstOrFail();

        $acc_account_cost_center->delete();

   

        return [
            'success' => 1,
            'msg' => __('lang_v1.deleted_success'),
        ];
    }
}
