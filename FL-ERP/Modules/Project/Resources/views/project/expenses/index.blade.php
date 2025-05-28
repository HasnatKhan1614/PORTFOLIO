@extends('layouts.app')
@section('title', 'Project Expenses')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('project::lang.project_expenses')
            <small>@lang('project::lang.manage_expenses')</small>
        </h1>
        <!-- <ol class="breadcrumb">
                                                                                                                                                                        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                                                                                                                                                                        <li class="active">Here</li>
                                                                                                                                                                    </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row no-print">
            <div class="col-md-12">
                @component('components.filters', ['title' => __('report.filters')])
                    <form id="filter_form">
                        <!-- Project ID Dropdown -->
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('pjt_project_id', __('project::lang.project') . ':') !!}
                                {!! Form::select('pjt_project_id', $projects->prepend('-- Select Project --', ''), null, [
                                    'class' => 'form-control',
                                    'id' => 'pjt_project_id',
                                ]) !!}
                            </div>
                        </div>

                        <!-- Name Dropdown -->
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('name', __('project::lang.name') . ':') !!}
                                {!! Form::select('name', $names->prepend('-- Select Name --', ''), null, [
                                    'class' => 'form-control',
                                    'id' => 'name',
                                ]) !!}
                            </div>
                        </div>

                        <!-- Start Date -->
                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('start_date', __('project::lang.start_date') . ':') !!}
                                {!! Form::date('start_date', null, ['class' => 'form-control', 'id' => 'start_date']) !!}
                            </div>
                        </div>

                        <!-- End Date -->
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('end_date', __('project::lang.end_date') . ':') !!}
                                {!! Form::date('end_date', null, ['class' => 'form-control', 'id' => 'end_date']) !!}
                            </div>
                        </div> --}}

                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('trending_product_date_range', __('report.date_range') . ':') !!}
                                {!! Form::text('date_range', null, [
                                    'placeholder' => __('lang_v1.select_a_date_range'),
                                    'class' => 'form-control',
                                    'id' => 'trending_product_date_range',
                                    'readonly',
                                ]) !!}
                            </div>
                        </div>


                        <!-- Apply and Reset Buttons -->
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-primary pull-right" id="apply_filters">
                                @lang('report.apply_filters')
                            </button>
                            <button type="button" class="btn btn-secondary pull-right" id="reset_filters"
                                style="margin-right: 10px;">
                                @lang('project::lang.reset_form')
                            </button>
                        </div>
                    </form>
                @endcomponent
            </div>
        </div>



        @component('components.widget', ['class' => 'box-primary', 'title' => 'All your expenses'])
            @slot('tool')
                <div class="box-tools">
                    <button type="button" class="btn btn-block btn-primary btn-modal add_expense_project_button"
                        data-href="{{ action([\Modules\Project\Http\Controllers\ExpenseController::class, 'create']) }}"
                        data-container=".project_expenses_modal">
                        <i class="fa fa-plus"></i>@lang('project::lang.add_expense')</button>
                </div>
            @endslot

            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="project_expense_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('project::lang.project')</th>
                            <th>@lang('project::lang.name')</th>
                            <th>@lang('project::lang.amount')</th>
                            <th>@lang('project::lang.date')</th>
                            <th>@lang('project::lang.remarks')</th>
                            <th>@lang('project::lang.action')</th>
                        </tr>
                    </thead>
<tfoot>
    <tr class="bg-gray font-17 text-center footer-total">
        <td colspan="3"><strong>@lang('project::lang.total'):</strong></td>
        <td id="total_amount" class="display_currency" data-currency_symbol="true"></td>
        <td colspan="3"></td>
    </tr>
</tfoot>

                </table>
            </div>
        @endcomponent

        <div class="modal fade project_expenses_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        </div>

    </section>

@endsection

@section('javascript')
    <script>
        $(document).ready(function() {


            var table = $('#project_expense_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('project/project-expense') }}",
                    data: function(d) {
                        d.date_range = $('#trending_product_date_range').val();
                        d.pjt_project_id = $('#pjt_project_id').val();
                        d.name = $('#name').val();
                    }
                },
                columns: [{
                        data: null,
                        name: 'index',
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        },
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'project_name',
                        name: 'project_name'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'amount',
                        name: 'amount',

                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row) {
                            return moment(data).format('YYYY-MM-DD');
                        }
                    },
                    {
                        data: 'remarks',
                        name: 'remarks'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
fnDrawCallback: function(settings) {
    $('#total_amount').html(sum_table_col($('#project_expense_table'), 'amount'));
    __currency_convert_recursively($('#project_expense_table'));
},

                createdRow: function(row, data, dataIndex) {
                    $(row).find('td:eq(2)').attr('class', 'clickable_td');
                }
            });



            // Handle Apply Filters button click
            $('#apply_filters').click(function() {
                table.ajax.reload();
            });

            // Handle Reset Filters button click
            $('#reset_filters').click(function() {
                $('#trending_product_date_range').val(''); // Reset date range
                $('#pjt_project_id').val('');
                $('#name').val('');
                table.ajax.reload();
            });

            // Clear date range on cancel
            $('#trending_product_date_range').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });


            //-----------------






            // Handle form submission
            $(document).on('submit', 'form#project_expense_add_form', function(e) {
                e.preventDefault();
                var form = $(this);

                // Determine the name value to send
                var nameSelect = $('#name_select').val();
                var nameValue = nameSelect === 'new_name' ? $('#new_name').val() : nameSelect;

                // Validate if "New Name" is selected but no value is entered
                if (nameSelect === 'new_name' && !nameValue) {
                    toastr.error('Please enter a new name.');
                    return;
                }

                // Replace the name_select value with the actual name value in the serialized data
                var data = form.serializeArray();
                data = data.filter(item => item.name !== 'name_select'); // Remove name_select from data
                data.push({
                    name: 'name',
                    value: nameValue
                }); // Add the correct name value

                $.ajax({
                    method: 'POST',
                    url: form.attr('action'),
                    dataType: 'json',
                    data: $.param(data), // Convert back to query string
                    beforeSend: function(xhr) {
                        __disable_submit_button(form.find('button[type="submit"]'));
                    },
                    success: function(result) {
                        if (result.success == true) {
                            $('div.project_expenses_modal').modal('hide');
                            toastr.success(result.msg);
                            table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('An error occurred while submitting the form.');
                    }
                });
            });

            //-----------------
            $(document).on('click', '.btn-modal', function(e) {
                e.preventDefault();
                var container = $(this).data('container');

                $.ajax({
                    url: $(this).data('href'),
                    dataType: 'html',
                    success: function(result) {
                        $(container)
                            .html(result)
                            .modal('show');
                    },
                });
            });

            //------------------

            // Handle edit button click
            $(document).on('click', 'button.edit_expense_project_button', function() {
                $('div.project_expenses_modal').load($(this).data('href'), function() {
                    $(this).modal('show');

                    // Initialize Select2
                    $('#name_select').select2();
                    $('#pjt_project_id').select2();

                    // Add "New Name" option after the first option ("-- Select Name --")
                    $('#name_select option:first').after(
                        '<option value="new_name">New Name</option>');

                    // Check if the current name is in the dropdown options
                    var currentName = $('#new_name').val(); // Pre-filled name
                    var nameExistsInDropdown = $('#name_select option[value="' + currentName + '"]')
                        .length > 0;

                    if (nameExistsInDropdown && currentName !== '') {
                        $('#name_select').val(currentName).trigger('change');
                    } else if (currentName !== '') {
                        $('#name_select').val('new_name').trigger('change');
                        $('#new_name_input').addClass('active');
                        $('#new_name').prop('required', true);
                    }

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

                    // Handle form submission
                    $('form#project_expense_edit_form').submit(function(e) {
                        e.preventDefault();
                        var form = $(this);

                        // Determine the name value to send
                        var nameSelect = $('#name_select').val();
                        var nameValue = nameSelect === 'new_name' ? $('#new_name').val() :
                            nameSelect;

                        // Validate if "New Name" is selected but no value is entered
                        if (nameSelect === 'new_name' && !nameValue) {
                            toastr.error('Please enter a new name.');
                            return;
                        }

                        // Replace the name_select value with the actual name value
                        var data = form.serializeArray();
                        data = data.filter(item => item.name !== 'name_select');
                        data.push({
                            name: 'name',
                            value: nameValue
                        });

                        $.ajax({
                            method: 'POST',
                            url: form.attr('action'),
                            dataType: 'json',
                            data: $.param(data),
                            beforeSend: function(xhr) {
                                __disable_submit_button(form.find(
                                    'button[type="submit"]'));
                            },
                            success: function(result) {
                                if (result.success === true) {
                                    $('div.project_expenses_modal').modal(
                                        'hide');
                                    toastr.success(result.msg);
                                    table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            },
                            error: function(xhr, status, error) {
                                toastr.error(
                                    'An error occurred while updating the expense.'
                                );
                            }
                        });
                    });
                });
            });

            $(document).on('click', 'button.delete_expense_project_button', function() {
                swal({
                    title: LANG.sure,
                    text: LANG.delete_message,
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                }).then(willDelete => {
                    if (willDelete) {
                        var href = $(this).data('href');
                        var data = $(this).serialize();

                        $.ajax({
                            method: 'DELETE',
                            url: href,
                            dataType: 'json',
                            data: data,
                            success: function(result) {
                                if (result.success == true) {
                                    toastr.success(result.msg);
                                    table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            },
                        });
                    }
                });
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            if ($('#trending_product_date_range').length == 1) {
                get_sub_categories();
                $('#trending_product_date_range').daterangepicker({
                    ranges: ranges,
                    autoUpdateInput: false,
                    locale: {
                        format: moment_date_format,
                        cancelLabel: LANG.clear,
                        applyLabel: LANG.apply,
                        customRangeLabel: LANG.custom_range,
                    },
                });
                $('#trending_product_date_range').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(
                        picker.startDate.format(moment_date_format) +
                        ' ~ ' +
                        picker.endDate.format(moment_date_format)
                    );
                });

                $('#trending_product_date_range').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });
            }
        });
    </script>

@endsection
