@extends('layouts.app')

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h3 class="page-title">Create Maintenance Item</h3>
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
                        <form id="form" class="form-Form-element" enctype="multipart/form-data">


                            @csrf
                            <input type="hidden" name="maintenance_request_id" value="{{ $maintenance_request_id }}">

                            <div class="box-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="title" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 form-label">Remarks</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="remarks"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" name="status" required>
                                            <option value="waiting">Waiting</option>
                                            <option value="first contact">First Contact</option>
                                            <option value="started">Started</option>
                                            <option value="in progress">In Progress</option>
                                            <option value="finished">Finished</option>
                                            <option value="unable to complete">Unable to Complete</option>
                                            <option value="quoted">Quoted</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 form-label">Attachments</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="attachments[]" class="form-control" multiple>
                                    </div>
                                </div>


                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right">Save</button>
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
    $("#form").submit(function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: '/maintenance-items/store',
            type: 'POST',
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

                setTimeout(() => {
                    window.location.href = "/maintenance-items?maintenance_request_id=" + $("input[name='maintenance_request_id']").val();
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
