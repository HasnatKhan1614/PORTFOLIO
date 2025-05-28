@extends('layouts.app')

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h3 class="page-title">All Maintenance Items</h3>
                </div>

            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">Maintenance Items</h4>
                            <div class="col-12">
                                <div class="bb-1 clearFix">
                                    <div class="text-end pb-15">
                                        <a class="btn btn-success"
                                            href="{{ url('/maintenance-items/create?maintenance_request_id=' . $maintenance_request_id) }}">
                                            <span><i class="fa fa-print"></i> Create</span> </a>
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
                                            <th>Remarks</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $key => $item)
                                            <tr id="item_{{ $item->id }}">
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->title }}</td>
                                                <td>{{ $item->remarks }}</td>
                                                <td>{{ ucfirst($item->status) }}</td>
                                                <td>
                                                    {{-- View button --}}
                                                    <a href="#" class="text-primary me-2" data-bs-toggle="modal"
                                                        data-bs-target="#viewItemModal"
                                                        onclick="viewItem({{ $item->toJson() }})" title="View">
                                                        <i class="ti-eye"></i>
                                                    </a>

                                                    @can('edit-maintenance-request-items')
                                                        <a href="{{ url('/maintenance-items/edit/' . $item->id) }}"
                                                            class="text-info me-10" data-bs-toggle="tooltip"
                                                            data-bs-original-title="Edit">
                                                            <i class="ti-marker-alt"></i>
                                                        </a>
                                                    @endcan

                                                    @can('delete-maintenance-request-items')
                                                        <a href="#" onclick="deleteItem({{ $item->id }})"
                                                            class="text-danger" data-bs-original-title="Delete"
                                                            data-bs-toggle="tooltip">
                                                            <i class="ti-trash"></i>
                                                        </a>
                                                    @endcan

                                                    @php
    $hasAttachments = $item->attachments && count($item->attachments) > 0;
@endphp

@if($hasAttachments)
    <a href="{{ route('maintenance-items.downloadAllAttachments', $item->id) }}"
       class="text-success me-2"
       title="Download All Attachments as ZIP">
        <i class="ti-download"></i> ZIP
    </a>
@endif
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
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

    <!-- View Modal -->
    <div class="modal fade" id="viewItemModal" tabindex="-1" aria-labelledby="viewItemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewItemModalLabel">Maintenance Item Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody id="viewItemTableBody">
                            <!-- JS will populate this -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function viewItem(item) {
            let html = `
      <tr><th>Title</th><td>${item.title}</td></tr>
      <tr><th>Remarks</th><td>${item.remarks}</td></tr>
      <tr><th>Status</th><td>${item.status}</td></tr>
    `;

            if (item.attachments && item.attachments.length) {
                let attachmentHtml = '';
                item.attachments.forEach(attachment => {
                    const ext = attachment.original_name.split('.').pop().toLowerCase();
                    const isImage = ['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(ext);
                    const isPdf = ext === 'pdf';

                    attachmentHtml += `
                <div class="mb-2">
                    <a href="/storage/${attachment.file_path}" target="_blank">${attachment.original_name}</a>
                    <a href="/maintenance-items/download/${attachment.id}" class="btn btn-sm btn-secondary ms-2">
                        Download
                    </a><br>
            `;

                    if (isImage) {
                        attachmentHtml +=
                            `<img src="/storage/${attachment.file_path}" class="img-thumbnail mt-1" style="max-height: 150px;">`;
                    } else if (isPdf) {
                        attachmentHtml +=
                            `<embed src="/storage/${attachment.file_path}" type="application/pdf" width="100%" height="200px">`;
                    }

                    attachmentHtml += `</div>`;
                });

                html += `<tr><th>Attachments</th><td>${attachmentHtml}</td></tr>`;
            }

            document.getElementById('viewItemTableBody').innerHTML = html;
        }
    </script>


    <script>
        function deleteItem(id) {
            alert(id);
            if (confirm("Are you sure you want to delete this item?")) {
                $.ajax({
                    url: `{{ url('/maintenance-items/delete/${id}') }}`,
                    type: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        alert(response.message);
                        $("#item_" + id).remove();
                    }
                });
            }
        }
    </script>
@endsection
