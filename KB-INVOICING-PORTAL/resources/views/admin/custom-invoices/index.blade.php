@extends('admin.layouts.app')

@section('content')
    {{-- <div class="card shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body d-flex align-items-center justify-content-between p-4">
            <h4 class="fw-semibold mb-0">Orders</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="{{ route('admin.orders.index') }}">Orders</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div> --}}

    <div class="datatables">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="fw-semibold mb-0">Orders</h4>
                            <a href="{{ route('admin.custom-invoices.create') }}"
                                class="btn me-1 mb-1 bg-primary-subtle text-primary px-4 fs-4 ">Create</a>
                        </div>
                        <div class="table-responsive">
                            <table id="table"
                                class="table border w-100 table-striped table-bordered display text-nowrap dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Invoice Number</th>
                                        <th>Customer Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Company</th>
                                        <th>Payment Status</th>
                                        <th>Total Price</th>
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
                ajax: "{{ route('admin.custom-invoices.index') }}",
                scrollX: true, // <-- enables horizontal scrolling
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'invoice_number',
                        name: 'invoice_number'
                    },
                    {
                        data: 'c_name',
                        name: 'c_name'
                    },
                    {
                        data: 'c_email',
                        name: 'c_email'
                    },
                    {
                        data: 'c_phone',
                        name: 'c_phone'
                    },

                    {
                        data: 'company_name',
                        name: 'company_name'
                    },


                    {
                        data: 'payment_status',
                        name: 'payment_status'
                    },
                    {
                        data: 'total_price',
                        name: 'total_price',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            // Handle Delete
            $('body').on('click', '.delete', function() {
                var id = $(this).data('id');
                var url = "{{ route('admin.custom-invoices.destroy', ':id') }}".replace(':id', id);

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'POST', // Use POST for compatibility
                            data: {
                                _method: 'DELETE', // Specify DELETE method for Laravel
                                _token: $('meta[name="csrf-token"]').attr(
                                    'content') // Include CSRF token
                            },
                            success: function(response) {
                                Swal.fire("Deleted!", response.message, "success");
                                if (typeof dataTable !== 'undefined') {
                                    dataTable.ajax
                                        .reload(); // Reload the DataTable if it exists
                                }
                            },
                            error: function(xhr) {
                                Swal.fire("Error!", "Failed to delete.", "error");
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
