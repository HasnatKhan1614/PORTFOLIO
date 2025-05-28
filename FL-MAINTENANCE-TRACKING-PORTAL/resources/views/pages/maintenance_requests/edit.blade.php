@extends('layouts.app')

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h3 class="page-title">Edit Maintenance Request</h3>
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
                        <form id="editMaintenanceForm" class="form-Form-element">
                            <input type="hidden" id="maintenance-request-id" value="{{ $maintenanceRequest->id }}">

                            <div class="box-body">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 form-label">Title</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="{{$maintenanceRequest->title}}" id="title" placeholder="Title"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 form-label">Building</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="building_id">
                                            @foreach ($buildings as $building)
                                                <option value="{{ $building->id }}"
                                                    {{ $maintenanceRequest->building_id == $building->id ? 'selected' : '' }}>
                                                    {{ $building->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                @role('superadmin')
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-label">Company</label>
                                        <div class="col-sm-10">
                                            <select class="form-select" id="company_id">
                                                @foreach ($companies as $company)
                                                    <option value="{{ $company->id }}"
                                                        {{ $maintenanceRequest->company_id == $company->id ? 'selected' : '' }}>
                                                        {{ $company->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endrole

                                <div class="form-group row">
                                    <label class="col-sm-2 form-label">Urgency</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="urgency">
                                            <option value="low"
                                                {{ $maintenanceRequest->urgency == 'low' ? 'selected' : '' }}>Low</option>
                                            <option value="medium"
                                                {{ $maintenanceRequest->urgency == 'medium' ? 'selected' : '' }}>Medium
                                            </option>
                                            <option value="high"
                                                {{ $maintenanceRequest->urgency == 'high' ? 'selected' : '' }}>High</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="status">
                                            <option value="waiting"
                                                {{ $maintenanceRequest->status == 'waiting' ? 'selected' : '' }}>Waiting
                                            </option>
                                            <option value="first contact"
                                                {{ $maintenanceRequest->status == 'first contact' ? 'selected' : '' }}>
                                                First
                                                Contact</option>
                                            <option value="started"
                                                {{ $maintenanceRequest->status == 'started' ? 'selected' : '' }}>Started
                                            </option>
                                            <option value="in progress"
                                                {{ $maintenanceRequest->status == 'in progress' ? 'selected' : '' }}>In
                                                Progress</option>
                                            <option value="finished"
                                                {{ $maintenanceRequest->status == 'finished' ? 'selected' : '' }}>Finished
                                            </option>
                                            <option value="unable to complete"
                                                {{ $maintenanceRequest->status == 'unable to complete' ? 'selected' : '' }}>
                                                Unable to Complete</option>
                                            <option value="quoted"
                                                {{ $maintenanceRequest->status == 'quoted' ? 'selected' : '' }}>Quoted
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                @role('superadmin|manager|admin')
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-label">Accounting Status</label>
                                        <div class="col-sm-10">
                                            <select class="form-select" id="accounting_status">
                                                <option value="awaiting completion"
                                                    {{ $maintenanceRequest->accounting_status == 'awaiting completion' ? 'selected' : '' }}>
                                                    Awaiting Completion</option>
                                                <option value="awaiting report"
                                                    {{ $maintenanceRequest->accounting_status == 'awaiting report' ? 'selected' : '' }}>
                                                    Awaiting Report</option>
                                                <option value="invoice sent"
                                                    {{ $maintenanceRequest->accounting_status == 'invoice sent' ? 'selected' : '' }}>
                                                    Invoice Sent</option>
                                                <option value="invoice paid"
                                                    {{ $maintenanceRequest->accounting_status == 'invoice paid' ? 'selected' : '' }}>
                                                    Invoice Paid</option>
                                                <option value="quoted"
                                                    {{ $maintenanceRequest->accounting_status == 'quoted' ? 'selected' : '' }}>
                                                    Quoted</option>
                                            </select>
                                        </div>
                                    </div>
                                @endrole

                                <div class="form-group row">
                                    <label class="col-sm-2 form-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="description">{{ $maintenanceRequest->description }}</textarea>
                                    </div>
                                </div>



                            </div>
                            <div class="box-footer">
                                <a href="/maintenance-requests" class="btn btn-danger me-1">Cancel</a>

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
        $(document).ready(function() {
            $("#editMaintenanceForm").submit(function(e) {
                e.preventDefault();

                let id = $("#maintenance-request-id").val();

                $.ajax({
                    url: "/maintenance-requests/update/" + id,
                    type: "POST",
                    data: {
                        id: id,
                        title: $("#title").val(),
                        building_id: $("#building_id").val(),
                        company_id: $("#company_id").val(),
                        urgency: $("#urgency").val(),
                        description: $("#description").val(),
                        status: $("#status").val(),
                        accounting_status: $("#accounting_status").val(),
                        _token: "{{ csrf_token() }}"
                    },
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

                        setTimeout(() => {
                            window.location.href = "/maintenance-requests";
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
        });
    </script>
@endsection
