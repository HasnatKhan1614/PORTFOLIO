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
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('start_date', __('project::lang.start_date') . ':') !!}
                                {!! Form::date('start_date', null, ['class' => 'form-control', 'id' => 'start_date']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('end_date', __('project::lang.end_date') . ':') !!}
                                {!! Form::date('end_date', null, ['class' => 'form-control', 'id' => 'end_date']) !!}
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-primary pull-right" id="apply_filters">
                                @lang('report.apply_filters')
                            </button>
                        </div>
                    </form>
                @endcomponent
            </div>
        </div>



        @component('components.widget', ['class' => 'box-primary', 'title' => 'All your expenses'])
                @slot('tool')
                    <div class="box-tools">
                        <button type="button" class="btn btn-block btn-primary btn-modal"
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
                                <th>@lang('project::lang.remarks')</th>
                                <th>@lang('project::lang.action')</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <th>#</th>
                                <th>@lang('project::lang.project')</th>
                                <th>@lang('project::lang.name')</th>
                                <th>@lang('project::lang.amount')</th>
                                <th>@lang('project::lang.remarks')</th>
                                <th>@lang('project::lang.action')</th>
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
        project_expense_table = $('#project_expense_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('project/project-expense') }}",
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
                    name: 'amount'
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
            createdRow: function(row, data, dataIndex) {
                $(row).find('td:eq(2)').attr('class', 'clickable_td');
            },
        });
        // Handle filter button click
        $('#apply_filters').click(function() {
            $.ajax({
                url: "{{ url('project/project-expense') }}",
                type: "GET",
                data: {
                    start_date: $('#start_date').val(),
                    end_date: $('#end_date').val()
                },
                success: function(response) {
                    project_expense_table.ajax.reload(); // Refresh DataTable with new data
                },
                error: function(xhr, status, error) {
                    console.log("AJAX Error:", error);
                }
            });
        });

        //-----------------

        $(document).on('submit', 'form#project_expense_add_form', function(e) {
            e.preventDefault();
            var form = $(this);
            var data = form.serialize();

            $.ajax({
                method: 'POST',
                url: $(this).attr('action'),
                dataType: 'json',
                data: data,
                beforeSend: function(xhr) {
                    __disable_submit_button(form.find('button[type="submit"]'));
                },
                success: function(result) {
                    if (result.success == true) {
                        $('div.project_expenses_modal').modal('hide');
                        toastr.success(result.msg);
                        project_expense_table.ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                },
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

        $(document).on('click', 'button.edit_expense_project_button', function() {
            $('div.project_expenses_modal').load($(this).data('href'), function() {
                $(this).modal('show');

                $('form#project_expense_edit_form').submit(function(e) {
                    e.preventDefault();
                    var form = $(this);
                    var data = form.serialize();

                    $.ajax({
                        method: 'POST',
                        url: $(this).attr('action'),
                        dataType: 'json',
                        data: data,
                        beforeSend: function(xhr) {
                            __disable_submit_button(form.find('button[type="submit"]'));
                        },
                        success: function(result) {
                            if (result.success == true) {
                                $('div.project_expenses_modal').modal('hide');
                                toastr.success(result.msg);
                                project_expense_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        },
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
                                project_expense_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        },
                    });
                }
            });
        });
    </script>

@endsection
