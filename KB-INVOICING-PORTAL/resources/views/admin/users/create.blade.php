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
                    <li class="breadcrumb-item" aria-current="page">
                        Create
                    </li>
                </ol>
            </nav>
        </div>
    </div> --}}

    <div class="card">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between align-items-center mt-3">
                <h4 class="fw-semibold mb-0">Users</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="{{ route('admin.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a href="{{ route('admin.users.index') }}">Users</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Create
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card-body">
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
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Handle Form Submission (Create/Update)
        $('body').on('submit', '#createForm', function(event) {
            event.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var method = form.attr('method');
            const csrfToken = $('meta[name="csrf-token"]').attr('content');


            $.ajax({
                url: url,
                type: method,
                data: form.serialize(),
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    Swal.fire("Success!", response.message, "success");
                    form.closest('.modal').modal('hide');
                    form[0].reset();
                    dataTable.ajax.reload();
                },
                error: function(xhr) {
                    Swal.fire("Error!", "Failed to submit data.", "error");
                }
            });
        });
    </script>
@endsection
