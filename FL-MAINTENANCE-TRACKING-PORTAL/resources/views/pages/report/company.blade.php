@extends('layouts.app')

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h3 class="page-title">All Companies</h3>
                </div>

            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">Companies</h4>
                            <div class="col-12">
                                <div class="bb-1 clearFix">
                                    <div class="text-end pb-15">
                                        <a class="btn btn-success" href="{{ url('/companies/create') }}"> <span><i
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
                                            <th>Tax Number</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($companies as $key => $item)
                                            <tr id="company_{{ $item->id }}">
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->tax_number }}</td>
                                               
                                                <td>         <a href="{{ url('/companies/show/' . $item->id) }}"
                                                        class="text-primary me-10" data-bs-toggle="tooltip"
                                                        data-bs-original-title="View Items">
                                                        <i class="ti-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <th>#</th>

                                        <th>Name</th>
                                        <th>Tax Number</th>
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
















