@extends('layouts.app')

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h3 class="page-title">Edit Role</h3>
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
                        <form method="POST"
                            action="{{ isset($role) ? route('roles.update', $role->id) : route('roles.store') }}">
                            <div class="box-body">
                                @csrf

                                <div class="form-group row">
                                    <label class="col-sm-2 form-label">Role Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" class="form-control" placeholder="Role Name"
                                            value="{{ old('name', $role->name ?? '') }}" required>
                                    </div>
                                </div>

                                <hr>

                     <div class="form-group row">
    @foreach ($permissions->flatten() as $permission)
        <div class="col-sm-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="permissions[]"
                    value="{{ $permission->name }}" id="perm_{{ $permission->id }}"
                    {{ isset($rolePermissions) && in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                <label class="form-check-label" for="perm_{{ $permission->id }}">
                    {{ ucfirst($permission->name) }}
                </label>
            </div>
        </div>
    @endforeach
</div>

                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-success">
                                    {{ isset($role) ? 'Update Role' : 'Create Role' }}
                                </button>
                            </div>
                            <!-- /.box-footer -->
                        </form>
                    </div>
                    <!-- /.box -->
                </div>



        </section>
        <!-- /.content -->
    </div>
@endsection


@section('script')
 
@endsection
