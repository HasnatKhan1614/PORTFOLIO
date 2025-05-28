@extends('layouts.app')

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h3 class="page-title">Create User</h3>
                    {{-- <div class="d-inline-block align-items-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a>
                                    </li>
                                    <li class="breadcrumb-item" aria-current="page">Tables</li>
                                    <li class="breadcrumb-item active" aria-current="page">Data Tables</li>
                                </ol>
                            </nav>
                        </div> --}}
                </div>

            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">Form</h4>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form id="createUserForm" method="POST" enctype="multipart/form-data" class="form-Form-element">
                            @csrf
                            <div class="box-body">

                                <div class="form-group row">
                                    <label class="col-sm-2 form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="username" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="email" required>
                                    </div>
                                </div>
                                @role('superadmin')
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-label">Company</label>
                                        <div class="col-sm-10">
                                            <select name="company_id" class="form-control" required>
                                                @foreach ($companies as $company)
                                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="role" class="col-sm-2 form-label">Role</label>
                                        <div class="col-sm-10">
                                            <select name="role" class="form-control" id="role">
                                                @foreach (\Spatie\Permission\Models\Role::all() as $role)
                                                    <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endrole

                                <div class="form-group row">
                                    <label class="col-sm-2 form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="password" required>
                                    </div>
                                </div>
                            </div>

                            <div class="box-footer">
                                <a href="/users" class="btn btn-danger me-1">Cancel</a>
                               <button type="submit" class="btn btn-warning ">Save</button>
                            </div>
                        </form>

                    </div>
                    <!-- /.box -->
                </div>



        </section>
        <!-- /.content -->
    </div>
@endsection


@section('script')
   <script>
    $('#createUserForm').submit(function(e) {
        e.preventDefault();

        let $form = $(this);
        let formData = new FormData(this);

        $.ajax({
            url: '/users/store',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $.toast({
                    heading: 'Success',
                    text: response.message,
                    position: 'top-right',
                    loaderBg: '#ff6849',
                    icon: 'success',
                    hideAfter: 3500,
                    stack: 6
                });

              // Redirect after short delay
                setTimeout(() => {
                    window.location.href = '/users';
                }, 1500);
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                let errorMsg = '';

                $.each(errors, function(key, value) {
                    errorMsg += value[0] + '<br>';
                });

                $.toast({
                    heading: 'Error',
                    text: errorMsg,
                    position: 'top-right',
                    loaderBg: '#ff6849',
                    icon: 'error',
                    hideAfter: 5000,
                    stack: 6
                });
            }
        });
    });
</script>

@endsection
