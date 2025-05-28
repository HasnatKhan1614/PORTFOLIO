@extends('admin.layouts.app')

@section('content')
    {{-- <div class="card shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body d-flex align-items-center justify-content-between p-4">
            <h4 class="fw-semibold mb-0">Servers</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="{{ route('admin.servers.index') }}">Servers</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div> --}}

    <div class="datatables">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    {{-- <div class="card-header">
                    </div> --}}
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="fw-semibold mb-0">Bank</h4>
                            <a href="{{ route('admin.banks.create') }}"
                                class="btn me-1 mb-1 bg-primary-subtle text-primary px-4 fs-4 ">Create</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="bankTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Bank Name</th>
                                        <th>Branch</th>
                                        <th>Currency</th>
                                        <th>Swift Code</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
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
    <script>
        $(function() {
            var dataTable = $('#bankTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.banks.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'bank_name'
                    },
                    {
                        data: 'branch'
                    },
                    {
                        data: 'currency'
                    },
                    {
                        data: 'swift_code'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });



            // Handle Delete
            $('body').on('click', '.delete', function() {
                var id = $(this).data('id');
                var url = "{{ route('admin.banks.destroy', ':id') }}".replace(':id', id);

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
