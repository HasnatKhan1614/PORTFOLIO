@extends('layouts.app')

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h3 class="page-title">All Users</h3>
                </div>

            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">Users</h4>
                            <div class="col-12">
                                <div class="bb-1 clearFix">
                                    <div class="text-end pb-15">
                                        <a class="btn btn-success" href="{{ url('/users/create') }}"> <span><i
                                                    class="fa fa-print"></i> Create</span> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="complex_header" class="table table-striped table-bordered display"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Username</th>
                                                                                   @role('superadmin')
                                            <th>Company</th>
                                        @endrole
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $key => $user)
                                            <tr id="user_{{ $user->id }}">
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->username }}</td>
                                                @role('superadmin')

                                                <td>{{ $user->company->name ?? '-' }}</td>
                                                @endrole
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
                                                <td>
                                                    <a href="/users/edit/{{ $user->id }}" class="text-info me-10"
                                                        data-bs-toggle="tooltip" title="Edit">
                                                        <i class="ti-marker-alt"></i>
                                                    </a>
                                                    <a href="#" onclick="deleteUser({{ $user->id }})"
                                                        class="text-danger" data-bs-toggle="tooltip" title="Delete">
                                                        <i class="ti-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Username</th>
                                                                                @role('superadmin')
                                            <th>Company</th>
                                        @endrole
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
@endsection

@section('script')
    <script>
        function deleteUser(id) {
            if (confirm('Are you sure you want to delete this user?')) {
                $.ajax({
                    url: '/users/delete/' + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        $('#user_' + id).remove();
                        alert('User deleted successfully!');
                    },
                    error: function() {
                        alert('Something went wrong!');
                    }
                });
            }
        }
    </script>
@endsection
