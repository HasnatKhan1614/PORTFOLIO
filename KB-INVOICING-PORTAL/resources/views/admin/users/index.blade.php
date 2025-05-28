@extends('admin.layouts.app')

@section('content')
    {{-- <div class="card shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body d-flex align-items-center justify-content-between p-4">
            <h4 class="fw-semibold mb-0">Users</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="{{ route('admin.users.index') }}">Users</a>
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
                            <h4 class="fw-semibold mb-0">Users</h4>
                            <a href="{{ route('admin.users.create') }}"
                                class="btn me-1 mb-1 bg-primary-subtle text-primary px-4 fs-4 ">Create</a>
                        </div>
                        <div class="table-responsive">
                            <table id="table"
                                class="table border w-100 table-striped table-bordered display text-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Action</th>
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

    <!-- Modal for Create -->
    {{-- <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createForm" method="POST" action="{{ route('admin.users.store') }}">
                        <div class="row">
                            <!-- Name Field -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="name">Name:</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter your name" required>
                                </div>
                            </div>

                            <!-- Email Field -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter your email" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="email">Password:</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Enter your password" required>
                                </div>
                            </div>

                            <!-- Phone Field -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="phone">Phone:</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="Enter your phone number">
                                </div>
                            </div>

                            <!-- Address Field -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="address">Address:</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Enter your address">
                                </div>
                            </div>

                            <!-- Description Field -->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="description">Description:</label>
                                    <textarea class="form-control" id="description" name="description" placeholder="Enter a description"></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>



                    <div class="modal-footer">
                        <button type="button" class="btn bg-danger-subtle text-danger  waves-effect text-start"
                            data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    <!-- Modal for Edit -->
    {{-- <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST">
                        @method('PUT')
                        <input type="hidden" class="form-control" id="id" name="id">

                        <div class="row">
                            <!-- Name Field -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="name">Name:</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter your name" required>
                                </div>
                            </div>

                            <!-- Email Field -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter your email" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="email">Password:</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Enter your password" required>
                                </div>
                            </div>

                            <!-- Phone Field -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="phone">Phone:</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="Enter your phone number">
                                </div>
                            </div>

                            <!-- Address Field -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="address">Address:</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Enter your address">
                                </div>
                            </div>

                            <!-- Description Field -->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="description">Description:</label>
                                    <textarea class="form-control" id="description" name="description" placeholder="Enter a description"></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>



                    <div class="modal-footer">
                        <button type="button" class="btn bg-danger-subtle text-danger  waves-effect text-start"
                            data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            var dataTable = $('#table').DataTable({
                ordering: false,
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.users.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },

                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });


            // Handle Modal (Create/Edit)
            // $('body').on('click', '.create, .edit', function() {
            //     var action = $(this).data('action');
            //     var modal = action === 'create' ? $('#createModal') : $('#editModal');
            //     var form = modal.find('form');
            //     var url = action === 'create' ?
            //         "{{ route('admin.users.store') }}" :
            //         "{{ route('admin.users.edit', ':id') }}".replace(':id', $(this).data('id'));

            //     // Reset form for create or load data for edit
            //     if (action === 'create') {
            //         form[0].reset();
            //         form.attr('action', "{{ route('admin.users.store') }}").attr('method', 'POST');
            //     } else {
            //         $.ajax({
            //             url: url,
            //             type: 'GET',
            //             success: function(data) {
            //                 form.find('input[name="id"]').val(data.id);
            //                 form.find('input[name="name"]').val(data.name);
            //                 form.find('input[name="email"]').val(data.email);
            //                 form.find('input[name="phone"]').val(data.phone);
            //                 form.find('input[name="address"]').val(data.address);
            //                 form.find('textarea[name="description"]').val(data.description);
            //                 form.attr('action', "{{ route('admin.users.update', ':id') }}"
            //                     .replace(':id', data.id)).attr('method', 'PUT');
            //             }
            //         });
            //     }
            //     modal.modal('show');
            // });

            // // Handle Form Submission (Create/Update)
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
                var id = $(this).data('id'); // Get the ID of the record
                var url = "{{ route('admin.users.destroy', ':id') }}".replace(':id', id); // Correct route

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
                            type: 'POST', // POST request to simulate DELETE
                            data: {
                                _method: 'DELETE', // Laravel will recognize this as DELETE
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
