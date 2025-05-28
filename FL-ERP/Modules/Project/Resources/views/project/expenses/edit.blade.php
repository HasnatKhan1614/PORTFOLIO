           <style>
               #new_name_input {
                   margin-top: 10px;
                   display: none;
               }

               #new_name_input.active {
                   display: block;
               }
           </style>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title">@lang('project::lang.edit_project_expenses')</h4>
        </div>

        {!! Form::open([
            'url' => action([\Modules\Project\Http\Controllers\ExpenseController::class, 'update'], [$project_expense->id]),
            'method' => 'PUT',
            'id' => 'project_expense_edit_form',
        ]) !!}

        <div class="modal-body">
            <div class="row align-items-start"> <!-- Changed to align-items-start for better control -->
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('pjt_project_id', __('project::lang.project') . ':') !!}
                        {!! Form::select('pjt_project_id', $projects, $project_expense ? $project_expense->pjt_project_id : null, [
                            'class' => 'form-control select2 pjt_project_id',
                            'placeholder' => __('messages.please_select'),
                        ]) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('name', __('project::lang.name') . ':*') !!}
                        {!! Form::select(
                            'name_select',
                            $names->prepend('-- Select Name --', ''),
                            $project_expense ? $project_expense->name : null,
                            [
                                'class' => 'form-control name_select',
                                'id' => 'name_select',
                                'required' => true,
                            ],
                        ) !!}
                        <div id="new_name_input" class="new-name-input">
                            {!! Form::text('name', $project_expense ? $project_expense->name : null, [
                                'class' => 'form-control new_name',
                                'id' => 'new_name',
                                'placeholder' => __('project::lang.enter_new_name'),
                            ]) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-start">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('amount', __('project::lang.amount') . ':*') !!}
                        {!! Form::text('amount', $project_expense ? $project_expense->amount : '', [
                            'class' => 'form-control input_number',
                            'required',
                        ]) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('remarks', __('project::lang.remarks') . ':*') !!}
                        {!! Form::text('remarks', $project_expense ? $project_expense->remarks : '', [
                            'class' => 'form-control',
                            'required',
                        ]) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">@lang('messages.save')</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
        </div>
        {!! Form::close() !!}
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

