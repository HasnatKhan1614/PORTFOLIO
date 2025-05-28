@extends('layouts.app')

@section('title', __('accounting::lang.journal_entry'))

@section('content')

    @include('accounting::layouts.nav')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('Journal Entry Items')</h1>
    </section>
    <section class="content no-print">
        <div class="row">
            <div class="col-md-12">
                @component('components.filters', ['title' => __('report.filters')])
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('journal_entry_date_range_filter', __('report.date_range') . ':') !!}
                            {!! Form::text('journal_entry_date_range_filter', null, [
                                'placeholder' => __('lang_v1.select_a_date_range'),
                                'class' => 'form-control',
                                'readonly',
                            ]) !!}
                        </div>
                    </div>
<div class="col-md-4">
    <div class="form-group">
        {!! Form::label('accounting_account_cost_center_id', 'Cost Center') !!}
        {!! Form::select('accounting_account_cost_center_id', ['' => 'All'] + $costCenters, null, ['class' => 'form-control credit']) !!}
    </div>
</div>

                @endcomponent
            </div>
        </div>
        @component('components.widget', ['class' => 'box-solid'])
            @can('accounting.add_journal')
                @slot('tool')
                @endslot
            @endcan

            <table class="table table-bordered table-striped" id="journal_table">
                <thead>
                    <tr>
                        <th>{{ __('#') }}</th>
                        <th>{{ __('Ref No') }}</th>
                        <th>{{ __('Operation Date') }}</th>
                        <th>{{ __('Account Name') }}</th>
                        <th>{{ __('Note') }}</th>
                        <th>{{ __('Type') }}</th>
                        <th>{{ __('Amount') }}</th>
                        <th>{{ __('Cost Center') }}</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        @endcomponent
    </section>

@stop

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            var itemId = "{{ $itemId }}"
            //Journal table
            journal_table = $('#journal_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/accounting/journal-entry/' + itemId,
                    data: function(d) {
                        var start = '';
                        var end = '';
                        var accounting_account_cost_center_id = '';

                        if ($('#journal_entry_date_range_filter').val()) {
                            start = $('#journal_entry_date_range_filter')
                                .data('daterangepicker')
                                .startDate.format('YYYY-MM-DD');
                            end = $('#journal_entry_date_range_filter')
                                .data('daterangepicker')
                                .endDate.format('YYYY-MM-DD');
                        }

                        if($('#accounting_account_cost_center_id').val())
                        {
                            accounting_account_cost_center_id = $('#accounting_account_cost_center_id')
                                .val();
                        }

                        console.log(start)
                        console.log(end)
                        console.log(accounting_account_cost_center_id)
                        d.start_date = start;
                        d.end_date = end;
                        d.accounting_account_cost_center_id = accounting_account_cost_center_id;
                    },
                },

                aaSorting: [
                    [1, 'desc']
                ],
                columns: [
                  { data: null, name: 'index', orderable: false, searchable: false },
                    {
                        data: 'ref_no',
                        name: 'ref_no'
                    },
                    {
                        data: 'operation_date',
                        name: 'operation_date'
                    },
                    {
                        data: 'account_name',
                        name: 'account_name'
                    },
                    {
                        data: 'note',
                        name: 'note'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    }, // ✅ changed
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'cost_center_name',
                        name: 'cost_center_name'
                    }
                ],
                drawCallback: function(settings) {
    var api = this.api();
    api.column(0, { search: 'applied', order: 'applied' }).nodes().each(function(cell, i) {
        cell.innerHTML = i + 1;
    });
}
            
            });

            $('#journal_entry_date_range_filter').daterangepicker(
                dateRangeSettings,
                function(start, end) {
                    $('#journal_entry_date_range_filter').val(start.format(moment_date_format) + ' ~ ' + end
                        .format(moment_date_format));
                    journal_table.ajax.reload();
                }
            );
            $('#journal_entry_date_range_filter').on('cancel.daterangepicker', function(ev, picker) {
                $('#journal_entry_date_range_filter').val('');
                journal_table.ajax.reload();
            });

            $('#accounting_account_cost_center_id').on('change', function() {
                journal_table.ajax.reload();
            });

            //Delete Sale
            $(document).on('click', '.delete_journal_button', function(e) {
                e.preventDefault();
                swal({
                    title: LANG.sure,
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                }).then(willDelete => {
                    if (willDelete) {
                        var href = $(this).data('href');
                        $.ajax({
                            method: 'DELETE',
                            url: href,
                            dataType: 'json',
                            success: function(result) {
                                if (result.success == true) {
                                    toastr.success(result.msg);
                                    journal_table.ajax.reload();
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
@endsection
