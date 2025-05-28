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
                                  <div class="row align-items-center">
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              {!! Form::label('pjt_project_id', __('project::lang.project') . ':') !!}
                                              {!! Form::select('pjt_project_id', $projects, null, [
                                                  'class' => 'form-control select2',
                                                  'placeholder' => __('messages.please_select'),
                                              ]) !!}
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              {!! Form::label('name', __('project::lang.name') . ':*') !!}
                                              {!! Form::select('name_select', $names->prepend('-- Select Name --', ''), null, [
                                                  'class' => 'form-control',
                                                  'id' => 'name_select',
                                                  'required' => true,
                                              ]) !!}
                                              <div id="new_name_input" class="new-name-input">
                                              {!! Form::label('name', __('project::lang.name') . ':*') !!}

                                                  {!! Form::text('name', null, [
                                                      'class' => 'form-control',
                                                      'id' => 'new_name',
                                                      'placeholder' => __('project::lang.enter_new_name'),
                                                  ]) !!}
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row align-items-center">
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              {!! Form::label('amount', __('project::lang.amount') . ':*') !!}
                                              {!! Form::text('amount', null, [
                                                  'class' => 'form-control input_number',
                                                  'required',
                                              ]) !!}
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              {!! Form::label('remarks', __('project::lang.remarks') . ':*') !!}
                                              {!! Form::text('remarks', null, [
                                                  'class' => 'form-control',
                                                  'required',
                                              ]) !!}
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="modal-footer">
                                  <button type="submit" class="btn btn-primary">@lang('messages.save')</button>

                                  <button type="button" class="btn btn-default"
                                      data-dismiss="modal">@lang('messages.close')</button>
                              </div>
                              {!! Form::close() !!}

                          </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->


                      <script>
                          //init create form
                          // Initialize Select2 if needed
                          $('#name_select').select2();
                          $('#pjt_project_id').select2();

                          // Add "New Name" option after the first option ("-- Select Name --")
                          $('#name_select option:first').after('<option value="new_name">New Name</option>');

                          // Toggle new name input visibility based on selection
                          $('#name_select').on('change', function() {
                              if ($(this).val() === 'new_name') {
                                  $('#new_name_input').addClass('active');
                                  $('#new_name').prop('required', true);
                              } else {
                                  $('#new_name_input').removeClass('active');
                                  $('#new_name').prop('required', false);
                                  $('#new_name').val(''); // Clear the text input
                              }
                          });
                          //init create form
                      </script>
