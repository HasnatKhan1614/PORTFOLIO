@extends('layouts.app')

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h3 class="page-title">Edit Company</h3>
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
                        <form id="editCompanyForm" class="form-Form-element">
                            <input type="hidden" id="company_id" value="{{ $company->id }}">

                            <div class="box-body">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 form-label">Company Name</label>

                                    <div class="col-sm-10">

                                        <input type="text" class="form-control" value="{{ $company->name }}"
                                            id="name" placeholder="Company Name" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 form-label">Tax Number</label>

                                    <div class="col-sm-10">

                                        <input type="text" class="form-control" value="{{ $company->tax_number }}"
                                            id="tax_number" placeholder="Tax Number" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 form-label">Email</label>

                                    <div class="col-sm-10">

                                        <input type="email" class="form-control" value="{{ $company->email }}"
                                            id="email" placeholder="Email" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 form-label">Address</label>

                                    <div class="col-sm-10">

                                        <input type="text" class="form-control" value="{{ $company->address }}"
                                            id="address" placeholder="Address" required>
                                    </div>
                                </div>

                            </div>
                            <!-- /.box-body -->
                                                  <div class="box-footer">
                                <a href="/companies" class="btn btn-danger me-1">Cancel</a>

                                <button type="submit" class="btn btn-warning ">Save</button>
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
   <script>
    $(document).ready(function() {
        $("#editCompanyForm").submit(function(e) {
            e.preventDefault();

            let id = $("#company_id").val();

            $.ajax({
                url: `/companies/update/${id}`,
                type: 'POST',
                data: {
                    name: $("#name").val(),
                    tax_number: $("#tax_number").val(),
                    email: $("#email").val(),
                    address: $("#address").val(),
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
                        window.location.href = "/companies";
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
