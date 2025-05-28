@extends('user.layouts.app')

@section('content')
    <div class="datatables">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="fw-semibold mb-0">Orders</h4>
                        </div>
                        <div class="table-responsive">
                            <table id="table" class="table border w-100 table-striped table-bordered display text-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Domain</th>
                                        <th>Payment Interval</th>
                                        <th>Payment Status</th>
                                        <th>Notes</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end File export -->
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            var dataTable = $('#table').DataTable({
                ordering: false,
                processing: true,
                serverSide: true,
                ajax: "{{ route('user.orders.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'domain',
                        name: 'domain'
                    },
                    {
                        data: 'payment_interval',
                        name: 'payment_interval'
                    },
                    {
                        data: 'payment_status',
                        name: 'payment_status'
                    },
                    {
                        data: 'notes',
                        name: 'notes'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });



        });
    </script>
@endsection
