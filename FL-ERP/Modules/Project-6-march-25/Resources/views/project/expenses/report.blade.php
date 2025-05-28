@extends('layouts.app')
@section('title', 'Project Expense Report')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('project::lang.project_expense_report')</h1>
        </ol> -->
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
                    <tbody>
                        <!-- Data will be populated by DataTables -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" style="text-align:right">Page Total:</th>
                            <th class="page-total"></th>
                        </tr>
                        <tr>
                            <th colspan="2" style="text-align:right">All Total:</th>
                            <th class="all-total"></th>
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
            var table = $('#project_expense_report_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('project/project-expense-report') }}",
                columns: [{
                        data: null, // Index column
                        name: 'index',
                        render: function(data, type, row, meta) {
                            return meta.row + 1; // Index starts from 1
                        },
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'project_name',
                        name: 'pjt_projects.name' // Searchable column
                    },
                    {
                        data: 'total_expense',
                        name: 'total_expense',
                        searchable: false, // Disable search on this column
                        render: $.fn.dataTable.render.number(',', '.', 2, '')
                    }
                ],
                footerCallback: function(row, data, start, end, display) {
                    var api = this.api();

                    // Calculate the page total for the current page
                    var pageTotal = api
                        .column(2, {
                            page: 'current'
                        }) // Column index 2 (total_expense)
                        .data()
                        .reduce(function(a, b) {
                            return parseFloat(a) + parseFloat(b);
                        }, 0);

                    // Get the all total from the server response
                    var allTotal = api.ajax.json().allTotal || 0; // Fallback to 0 if not available

                    // Directly target the .page-total and .all-total elements
                    var $tfoot = $('#project_expense_report_table tfoot');
                    var $pageTotalCell = $tfoot.find('tr:eq(0) .page-total'); // First row, .page-total
                    var $allTotalCell = $tfoot.find('tr:eq(1) .all-total'); // Second row, .all-total

                    // Update footer for page total
                    $pageTotalCell.html(
                        $.fn.dataTable.render.number(',', '.', 2, '').display(pageTotal)
                    );

                    // Update footer for all total
                    $allTotalCell.html(
                        $.fn.dataTable.render.number(',', '.', 2, '').display(allTotal)
                    );
                }
            });
        });
    </script>

@endsection
