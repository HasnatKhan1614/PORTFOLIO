@extends('layouts.app')

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h3 class="page-title">All Maintenance Requests</h3>
                </div>

            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">Maintenance Requests</h4>
                            <div class="col-12">
                                <div class="bb-1 clearFix">
                                    <div class="text-end pb-15">
                                        @canany(['create-maintenance-requests'])
                                            <a class="btn btn-success" href="{{ url('/maintenance-requests/create') }}">
                                                <span><i class="fa fa-print"></i> Create</span> </a>
                                        @endcanany

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
                                            <th>Title</th>
                                            <th>Building</th>
                                            @role('superadmin')
                                                <th>Company</th>
                                            @endrole
                                            <th>Urgency</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="maintenanceTable">
                                        @foreach ($maintenanceRequests as $key => $request)
                                            <tr id="m_request_{{ $request->id }}">
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $request->title }}</td>
                                                <td>{{ $request->building->name }}</td>
                                                @role('superadmin')
                                                    <td>{{ $request->company->name ?? '' }}</td>
                                                @endrole

                                                <td>
                                                    <span
                                                        class="badge {{ $request->urgency == 'low' ? 'bg-success' : ($request->urgency == 'medium' ? 'bg-warning' : 'bg-danger') }}">
                                                        {{ ucfirst($request->urgency) }}
                                                    </span>
                                                </td>

                                                <td>
                                                    <span
                                                        class="badge 
                                                                {{ $request->status == 'waiting'
                                                                    ? 'bg-secondary'
                                                                    : ($request->status == 'first contact'
                                                                        ? 'bg-info'
                                                                        : ($request->status == 'started'
                                                                            ? 'bg-primary'
                                                                            : ($request->status == 'in progress'
                                                                                ? 'bg-warning'
                                                                                : ($request->status == 'finished'
                                                                                    ? 'bg-success'
                                                                                    : ($request->status == 'unable to complete'
                                                                                        ? 'bg-danger'
                                                                                        : 'bg-dark'))))) }}">
                                                        {{ ucfirst($request->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @can('edit-maintenance-requests')
                                                        <a href="{{ url('/maintenance-requests/edit/' . $request->id) }}"
                                                            class="text-info me-10" data-bs-toggle="tooltip"
                                                            data-bs-original-title="Edit">
                                                            <i class="ti-marker-alt"></i>
                                                        </a>
                                                    @endcan

                                                    <a href="{{ url('/maintenance-items?maintenance_request_id=' . $request->id) }}"
                                                        class="text-primary me-10" data-bs-toggle="tooltip"
                                                        data-bs-original-title="View Items">
                                                        <i class="ti-eye"></i>
                                                    </a>

                                                    @can('delete-maintenance-requests')
                                                        <a href="#" onclick="deleteItem({{ $request->id }})"
                                                            class="text-danger" data-bs-toggle="tooltip"
                                                            data-bs-original-title="Delete">
                                                            <i class="ti-trash"></i>
                                                        </a>
                                                    @endcan

                                                    @can('create-maintenance-request-items')
                                                        <a href="/maintenance-items/create?maintenance_request_id={{ $request->id }}"
                                                            class="text-success" data-bs-toggle="tooltip" title="Add Item">
                                                            <i class="ti-plus"></i>
                                                        </a>
                                                    @endcan
                                                </td>


                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <th>#</th>

                                        <th>Building</th>
                                        @role('superadmin')
                                            <th>Company</th>
                                        @endrole

                                        <th>Urgency</th>
                                        <th>Status</th>
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
            if (confirm("Are you sure you want to delete this company?")) {
                $.ajax({
                    url: "/companies/delete/" + id,
                    type: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        toastr.success(response.message);
                        $("#company_" + id).remove();
                    },
                    error: function(xhr) {
                        console.log(xhr);

                        let errorMsg = 'Something went wrong.';

                        try {
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMsg = xhr.responseJSON.message;
                            } else if (xhr.status === 403) {
                                errorMsg = 'You are not authorized to perform this action.';
                            } else if (xhr.responseText) {
                                // fallback for plain-text errors
                                errorMsg = xhr.responseText;
                            }
                        } catch (e) {
                            console.error('Error parsing error response', e);
                        }

                        toastr.error(errorMsg);
                    }

                });
            }
        }
    </script>
@endsection
