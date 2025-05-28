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
                    <li class="breadcrumb-item" aria-current="page">
                        Edit
                    </li>
                </ol>
            </nav>
        </div>
    </div> --}}

    <div class="card">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between align-items-center mt-3">
                <h4 class="fw-semibold mb-0">Servers</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="{{ route('admin.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a href="{{ route('admin.servers.index') }}">Servers</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Edit
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card-body">
            <form id="editForm" method="POST" action="{{ route('admin.servers.update', $server->id) }}">
                @method('PUT')
                <div class="row">
                    <!-- Name Field -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="name">Name:</label>
                            <input type="text" class="form-control" id="name" value="{{ $server->name }}"
                                name="name" placeholder="Enter your name" required>
                        </div>
                    </div>

                    <!-- Type Field -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="server">Type:</label>
                            <select class="form-control" name="type" id="type">
                                <option value="Linux VPS Hosting" @selected($server->type == 'Linux VPS Hosting')>Linux VPS Hosting</option>
                                <option value="Linux Reseller Hosting" @selected($server->type == 'Linux Reseller Hosting')>Linux Reseller Hosting
                                </option>
                                <option value="Linux Shared Hosting" @selected($server->type == 'Linux Shared Hosting')>Linux Shared Hosting
                                </option>
                                <option value="Dedicated SSD Servers" @selected($server->type == 'Dedicated SSD Servers')>Dedicated SSD Servers
                                </option>
                                <option value="Dedicated Servers" @selected($server->type == 'Dedicated Servers')>Dedicated Servers</option>
                            </select>
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
        $('body').on('submit', '#editForm', function(event) {
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
