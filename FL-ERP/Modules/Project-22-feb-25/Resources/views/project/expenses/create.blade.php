            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>

                        <h4 class="modal-title">@lang('project::lang.add_project_expenses')</h4>
                    </div>

                    {!! Form::open([
                        'url' => action([\Modules\Project\Http\Controllers\ExpenseController::class, 'store']),
                        'method' => 'post',
                        'id' => 'project_expense_add_form',
                    ]) !!}

                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('project_id', __('project::lang.project') . ':') !!}
                                    {!! Form::select('project_id', $projects, null, [
                                        'class' => 'form-control select2',
                                        'placeholder' => __('messages.please_select'),
                                        'style' => 'width: 100%;',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('name', __('project::lang.name') . ':*') !!}
                                    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('amount', __('project::lang.amount') . ':*') !!}
                                    {!! Form::text('amount', null, ['class' => 'form-control input_number', 'required']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('remarks', __('project::lang.remarks') . ':*') !!}
                                    {!! Form::text('remarks', null, ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit"
                            class="btn btn-primary">@lang('messages.save')</button>

                        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
                    </div>
                    {!! Form::close() !!}

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
