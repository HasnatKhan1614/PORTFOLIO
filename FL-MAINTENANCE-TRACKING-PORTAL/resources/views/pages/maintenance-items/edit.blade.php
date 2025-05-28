@extends('layouts.app')

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h3 class="page-title">Edit Maintenance Item</h3>
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
                        <form id="maintenanceItemEditForm" action="{{ url('/maintenance-items/update/' . $item->id) }}"
                            method="POST" enctype="multipart/form-data" class="form-Form-element">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="maintenance_request_id" value="{{ $item->maintenance_request_id }}">

                            <div class="box-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="title"
                                            value="{{ $item->title }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 form-label">Remarks</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="remarks">{{ $item->remarks }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" name="status" required>
                                            @foreach (['waiting', 'first contact', 'started', 'in progress', 'finished', 'unable to complete', 'quoted'] as $status)
                                                <option value="{{ $status }}"
                                                    @if ($item->status == $status) selected @endif>
                                                    {{ ucfirst($status) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 form-label">Attachments</label>
                                    <div class="col-sm-10">
                                        @foreach ($item->attachments as $attachment)
                                            <div class="mb-3">
                                                <div class="mb-1 d-flex align-items-center">
                                                    <a href="{{ asset('storage/' . $attachment->file_path) }}"
                                                        target="_blank" class="me-2">
                                                        {{ $attachment->original_name }}
                                                    </a>
                                                    <a href="{{ route('maintenance-items.download', $attachment->id) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="ti-download"></i> Download
                                                    </a>
                                                </div>

                                                {{-- Preview for images or PDF --}}
                                                @php
                                                    $ext = pathinfo($attachment->original_name, PATHINFO_EXTENSION);
                                                    $isImage = in_array(strtolower($ext), [
                                                        'jpg',
                                                        'jpeg',
                                                        'png',
                                                        'gif',
                                                        'webp',
                                                    ]);
                                                    $isPdf = strtolower($ext) === 'pdf';
                                                @endphp

                                                @if ($isImage)
                                                    <img src="{{ asset('storage/' . $attachment->file_path) }}"
                                                        alt="Preview" class="img-thumbnail mb-2"
                                                        style="max-height: 200px;">
                                                @elseif ($isPdf)
                                                    <embed src="{{ asset('storage/' . $attachment->file_path) }}"
                                                        type="application/pdf" width="100%" height="200px" class="mb-2">
                                                @endif
                                            </div>
                                        @endforeach

                                        <input type="file" name="attachments[]" multiple>
                                    </div>
                                </div>


                            </div>

                            <div class="box-footer">

                                <button type="submit" class="btn btn-info pull-right">Update</button>
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
            $('#maintenanceItemEditForm').submit(function(e) {
                e.preventDefault();

                let form = $(this)[0];
                let formData = new FormData(form);

                $.ajax({
                    url: $(form).attr('action'),
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

                        setTimeout(() => {
                            window.location.href =
                                "/maintenance-items?maintenance_request_id={{ $item->maintenance_request_id }}";
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
