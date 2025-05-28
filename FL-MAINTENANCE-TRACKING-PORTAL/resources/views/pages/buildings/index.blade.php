@extends('layouts.app')

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h3 class="page-title">All Buildings</h3>
                </div>

            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">Buildings</h4>
                            <div class="col-12">
                                <div class="bb-1 clearFix">
                                    <div class="text-end pb-15">
                                        <a class="btn btn-success" href="{{ url('/buildings/create') }}"> <span><i
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
                                            <th>Company</th>
                                            <th>Tax Number</th>
                                            <th>Address</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($buildings as $key => $building)
                                            <tr id="building_{{ $building->id }}">
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $building->name }}</td>
                                                <td>{{ $building->company->name }}</td>
                                                <td>{{ $building->tax_number }}</td>
                                                <td>{{ $building->address }}</td>
                                                <td><a href="/buildings/edit/{{ $building->id }}" class="text-info me-10"
                                                        data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                                        <i class="ti-marker-alt"></i>
                                                    </a>
                                                    <a href="#" onclick="deleteItem({{ $building->id }})"
                                                        class="text-danger" data-bs-original-title="Delete"
                                                        data-bs-toggle="tooltip">
                                                        <i class="ti-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <th>#</th>

                                        <th>Name</th>
                                        <th>Tax Number</th>
                                        <th>Address</th>
                                        <th>Actions</th>
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
        function deleteItem(id) {
            if (confirm("Are you sure you want to delete this item?")) {
                $.ajax({
                    url: `/buildings/delete/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        alert(response.message);
                        $("#building_" + id).remove();
                    }
                });
            }
        }
    </script>
@endsection
