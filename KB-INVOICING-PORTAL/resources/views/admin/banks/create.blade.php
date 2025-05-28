@extends('admin.layouts.app')

@section('content')
    {{-- <div class="card shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body d-flex align-items-center justify-content-between p-4">
            <h4 class="fw-semibold mb-0">Banks</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="{{ route('admin.servers.index') }}">Banks</a>
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
                <h4 class="fw-semibold mb-0">Banks</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="{{ route('admin.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a href="{{ route('admin.servers.index') }}">Banks</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Create
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card-body">
            <form id="createForm" action="{{ route('admin.banks.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="bank_name" class="form-label">Bank Name</label>
                            <input type="text" name="bank_name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="account_name" class="form-label">Account Name</label>
                            <input type="text" name="account_name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="account_number" class="form-label">Account Number</label>
                            <input type="text" name="account_number" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="iban" class="form-label">Iban</label>
                            <input type="text" name="iban" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="branch" class="form-label">Branch</label>
                            <input type="text" name="branch" class="form-control">
                        </div>
                    </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="currency" class="form-label">Currency</label>
                                <select name="currency" class="form-select">
                                    <option value="USD">USD</option>
                                    <option value="GBP">GBP</option>
                                    <option value="PKR">PKR</option>
                                    <option value="MYR">MYR</option>
                                </select>
                            </div>
                        </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="swift_code" class="form-label">SWIFT Code</label>
                            <input type="text" name="swift_code" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
           $('body').on('submit', '#createForm', function(event) {
                event.preventDefault();

                let form = $(this);
                let actionUrl = form.attr('action');
                let method = form.attr('method');
                let formData = form.serialize();

                $.ajax({
                    url: actionUrl,
                    method: method,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire("Success", response.message, "success")
                            .then(() => {
                                window.location.href = "{{ route('admin.banks.index') }}";
                            });
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorList = '';

                        $.each(errors, function(key, value) {
                            errorList += value + '<br>';
                        });

                        Swal.fire("Error", errorList || 'Something went wrong.', "error");
                    }
                });
            });
        });
    </script>
@endsection
