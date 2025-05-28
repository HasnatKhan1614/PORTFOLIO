@extends('admin.layouts.app')

@section('content')
    {{-- <div class="card shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body d-flex align-items-center justify-content-between p-4">
            <h4 class="fw-semibold mb-0">Products</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="{{ route('admin.products.index') }}">Products</a>
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
                            <h4 class="fw-semibold mb-0">Products</h4>
                            <a href="{{ route('admin.products.create') }}"
                                class="btn bg-primary-subtle text-primary px-4 fs-4">Create</a>
                        </div>
                        <div class="table-responsive">
                            <table id="table"
                                class="table border w-100 table-striped table-bordered display text-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
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
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Create Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createForm" method="POST" action="{{ route('admin.products.store') }}">
                        <div class="row">
                            <!-- Name Field -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="name">Name:</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter your name" required>
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
    </div>


    <!-- Modal for Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Edit Product</h5>
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
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {

            var dataTable = $('#table').DataTable({
                ordering: false,
                processing: true,
                productSide: true,
                ajax: "{{ route('admin.products.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
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
            // $('body').on('click', '.create, .edit', function () {
            //     var action = $(this).data('action');
            //     var modal = action === 'create' ? $('#createModal') : $('#editModal');
            //     var form = modal.find('form');
            //     var url = action === 'create' 
            //         ? "{{ route('admin.products.store') }}" 
            //         : "{{ route('admin.products.edit', ':id') }}".replace(':id', $(this).data('id'));

            //     // Reset form for 'create' or load data for 'edit'
            //     if (action === 'create') {
            //         form[0].reset(); // Clear form inputs
            //         form.attr('action', "{{ route('admin.products.store') }}").attr('method', 'POST');
            //     } else {
            //         $.ajax({
            //             url: url,
            //             type: 'GET',
            //             success: function (data) {
            //                 console.log(data);
            //                 // Populate form inputs with data for editing
            //                 form.find('input[name="id"]').val(data.id);
            //                 form.find('input[name="name"]').val(data.name);

            //                 // Correct the syntax here to properly update the form action and method
            //                 form.attr('action', "{{ route('admin.products.update', ':id') }}".replace(':id', data.id))
            //                     .attr('method', 'POST'); // Use POST since Laravel's PUT/PATCH needs spoofing
            //             },
            //             error: function (xhr, status, error) {
            //                 console.error("Error loading data for editing:", error);
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
                var url = "{{ route('admin.products.destroy', ':id') }}".replace(':id', id);

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
