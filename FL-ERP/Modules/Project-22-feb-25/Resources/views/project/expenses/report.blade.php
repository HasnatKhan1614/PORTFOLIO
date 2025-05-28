@extends('layouts.app')
@section('title', 'Project Expense Report')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('project::lang.project_expense_report')</h1>                                                                          </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
        @component('components.widget', ['class' => 'box-primary', 'title' => __('all_project_expense_report')])
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="project_expense_report_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('project::lang.project')</th>
                                <th>@lang('project::lang.total_expense')</th>
                            </tr>
                        </thead>
                        <tfoot>
                                <th>#</th>
                                <th>@lang('project::lang.project')</th>
                                <th>@lang('project::lang.total_expense')</th>
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
            $('#project_expense_report_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('project/project-expense-report') }}",
                columns: [{
                        data: null, // Use null for the index column
                        name: 'index',
                        render: function(data, type, row, meta) {
                            return meta.row + 1; // Index starts from 1
                        },
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'project_name',
                        name: 'project.project_name'
                    },
                    {
                        data: 'total_expense',
                        name: 'total_expense',
                        render: $.fn.dataTable.render.number(',', '.', 2, '')
                    }
                ]
            });
        });
    </script>

@endsection
