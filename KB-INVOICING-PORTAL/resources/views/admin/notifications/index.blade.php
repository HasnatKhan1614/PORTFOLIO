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
                            <h4 class="fw-semibold mb-0">Notifications</h4>
                        </div>
                        <div class="table-responsive">
                            <table id="table" class="table border w-100 table-striped table-bordered display text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Invoice Number</th>
                                        <th>Type</th>
                                        <th>Channel</th>
                                        <th>Sent At</th>
                                        <th>Status</th>
                                        <th>Response Details</th>
                                    </tr>
                                    <!-- end row -->
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
                ajax: "{{ route('admin.notifications.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'user_name',
                        name: 'user_name'
                    },
                    {
                        data: 'invoice_number',
                        name: 'invoice_number'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'channel',
                        name: 'channel'
                    },
                    {
                        data: 'sent_at',
                        name: 'sent_at'
                    },
                    {
                        data: 'is_successful',
                        name: 'is_successful',
                        render: function(data) {
                            return data ? '<span class="text-success">Successful</span>' :
                                '<span class="text-danger">Failed</span>';
                        }
                    },
                    {
                        data: 'response_details',
                        name: 'response_details',
                        render: function(data) {
                            return data ? data : 'N/A';
                        }
                    },
                ]
            });


            // Handle Modal (Create/Edit)
            // $('body').on('click', '.create, .edit', function() {
            //     var action = $(this).data('action');
            //     var modal = action === 'create' ? $('#createModal') : $('#editModal');
            //     var form = modal.find('form');
            //     var url = action === 'create' ?
            //         "{{ route('admin.servers.store') }}" :
            //         "{{ route('admin.servers.edit', ':id') }}".replace(':id', $(this).data('id'));

            //     // Reset form for create or load data for edit
            //     if (action === 'create') {
            //         form[0].reset();
            //         form.attr('action', "{{ route('admin.servers.store') }}").attr('method', 'POST');
            //     } else {
            //         $.ajax({
            //             url: url,
            //             type: 'GET',
            //             success: function(data) {
            //                 console.log(data)
            //                 form.find('input[name="id"]').val(data.id);
            //                 form.find('input[name="name"]').val(data.name);
            //                 // Set selected value for select field (type)
            //                 form.find('select[name="type"]').val(data.type).trigger(
            //                 'change'); // Auto-select the correct type
            //                 form.attr('action', "{{ route('admin.servers.update', ':id') }}"
            //                     .replace(':id', data.id)).attr('method', 'PUT');
            //             }
            //         });
            //     }
            //     modal.modal('show');
            // });

            // Handle Form Submission (Create/Update)
            // $('body').on('submit', '#createForm, #editForm', function(event) {
            //     event.preventDefault();
            //     var form = $(this);
            //     var url = form.attr('action');
            //     var method = form.attr('method');
            //     const csrfToken = $('meta[name="csrf-token"]').attr('content');


            //     $.ajax({
            //         url: url,
            //         type: method,
            //         data: form.serialize(),
            //         headers: {
            //             'X-CSRF-TOKEN': csrfToken
            //         },
            //         success: function(response) {
            //             Swal.fire("Success!", response.message, "success");
            //             form.closest('.modal').modal('hide');
            //             form[0].reset();
            //             dataTable.ajax.reload();
            //         },
            //         error: function(xhr) {
            //             Swal.fire("Error!", "Failed to submit data.", "error");
            //         }
            //     });
            // });

            // Handle Delete
            $('body').on('click', '.delete', function() {
                var id = $(this).data('id');
                var url = "{{ route('admin.servers.destroy', ':id') }}".replace(':id', id);

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
                            type: 'POST', // Use POST because some browsers don't allow DELETE method directly
                            data: {
                                _method: 'DELETE', // Laravel recognizes this as a DELETE request
                                _token: $('meta[name="csrf-token"]').attr(
                                    'content') // CSRF token
                            },
                            success: function(response) {
                                Swal.fire("Deleted!", response.message, "success");
                                dataTable.ajax.reload(); // Reload DataTable
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
