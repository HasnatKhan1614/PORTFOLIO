@extends('admin.layouts.app')

@section('content')
    {{-- <div class="card shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body d-flex align-items-center justify-content-between p-4">
            <h4 class="fw-semibold mb-0">Orders</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="{{ route('admin.orders.index') }}">Orders</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        Edit
                    </li>
                </ol>
            </nav>
        </div>
    </div> --}}

    <div class="card">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between align-items-center mt-3">
                <h4 class="fw-semibold mb-0">Orders</h4>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="{{ route('admin.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a href="{{ route('admin.custom-invoices.index') }}">Orders</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Edit
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card-body">
            <form id="editForm" action="{{ route('admin.custom-invoices.update', $invoice->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <input type="hidden" name="id" value="{{ $invoice->id }}">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Customer Name</label>
                            <input type="text" name="c_name" class="form-control" value="{{ $invoice->c_name }}"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Customer Email</label>
                            <input type="email" name="c_email" class="form-control" value="{{ $invoice->c_email }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Customer Phone</label>
                            <input type="text" name="c_phone" class="form-control" value="{{ $invoice->c_phone }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Customer Address</label>
                            <input type="text" name="c_address" class="form-control" value="{{ $invoice->c_address }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Company Name</label>
                            <input type="text" name="company_name" class="form-control"
                                value="{{ $invoice->company_name }}" required>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Banks</label>

                                @foreach ($banks as $bank)
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="bank_information_ids[]"
                                                value="{{ $bank->id }}" id="bank-{{ $bank->id }}"
                                                {{ in_array($bank->id, $order->invoice ?? []) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="bank-{{ $bank->id }}">
                                                {{ $bank->bank_name }} - {{ $bank->account_number }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Payment Status</label>
                            <select name="payment_status" class="form-select">
                                <option value="1" {{ $invoice->payment_status ? 'selected' : '' }}>Paid</option>
                                <option value="0" {{ !$invoice->payment_status ? 'selected' : '' }}>Unpaid</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="currency" class="form-label">Currency</label>
                                <select name="currency" class="form-select">
                                    <option value="USD" {{ $invoice->currency == 'USD' ? 'selected' : '' }}>USD</option>
                                    <option value="GBP" {{ $invoice->currency == 'GBP' ? 'selected' : '' }}>GBP</option>
                                    <option value="PKR" {{ $invoice->currency == 'PKR' ? 'selected' : '' }}>PKR</option>
                                    <option value="PKR" {{ $invoice->currency == 'MYR' ? 'selected' : '' }}>MYR</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Logo</label>
                            <input type="file" name="logo_image" class="form-control">
                            @if ($invoice->logo_image)
                                <img src="{{ asset('storage/' . $invoice->logo_image) }}" class="mt-2" width="80">
                            @endif
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Notes</label>
                            <textarea name="notes" class="form-control" rows="4">{{ $invoice->notes }}</textarea>
                        </div>
                    </div>

                    <!-- Appendable Order Details -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Order Details</h5>
                        <button type="button" class="btn btn-success" id="addItemContainer">
                            <i class="fas fa-box-open"></i> <!-- Cart icon from Bootstrap -->
                        </button>
                    </div>

                    {{-- Order Details Field --}}
                    <div id="itemContainer">
                        @php
                            $metaData = is_array($invoice->meta_data)
                                ? $invoice->meta_data
                                : json_decode($invoice->meta_data ?? '[]', true);
                        @endphp

                        @foreach ($metaData as $index => $detail)
                            <div class="order-detail mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="order_details[{{ $index }}][description]"
                                            class="form-control" >{{ $detail['description'] ?? '' }}</textarea>
                                    </div>
                                    <div class="col-md-1">
                                        <label class="form-label">Qty</label>
                                        <input type="number" name="order_details[{{ $index }}][quantity]"
                                            class="form-control" value="{{ $detail['quantity'] ?? '' }}">
                                    </div>
                                    <div class="col-md-1">
                                        <label class="form-label">Price</label>
                                        <input type="number" step="0.01"
                                            name="order_details[{{ $index }}][price]" class="form-control"
                                            value="{{ $detail['price'] ?? '' }}">
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="start_date[]" class="form-label">Start Date</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="ti ti-calendar fs-5"></i>
                                                </span>
                                                <input type="date" value="{{ $detail->start_date }}" name="order_details[{{ $index }}][start_date]" id="start_date_0"
                                                    class="form-control pickadate-selectors picker__input start-date" placeholder="Start Date" required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="end_date[]" class="form-label">End Date</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="ti ti-calendar fs-5"></i>
                                                </span>
                                                <input type="date" value="{{ $detail->end_date }}" name="order_details[{{ $index }}][end_date]" id="end_date_0"
                                                    class="form-control pickadate-selectors picker__input end-date" placeholder="End Date" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Free Service</label>
                                        <select name="order_details[{{ $index }}][is_free]" class="form-select">
                                            <option value="1" {{ ($detail['is_free'] ?? 0) == 1 ? 'selected' : '' }}>
                                                Yes</option>
                                            <option value="0" {{ ($detail['is_free'] ?? 0) == 0 ? 'selected' : '' }}>
                                                No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1 mt-4">
                                        <button type="button" class="btn btn-danger removeOrderDetail"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary">Update Order</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('body').on('submit', '#editForm', function(event) {
            event.preventDefault();

            var formElement = $(this)[0]; // Native DOM element
            var $form = $(this); // jQuery object for attributes
            var url = $form.attr('action');
            var method = $form.attr('method');
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Create FormData object for file + data support
            let formData = new FormData(formElement);

            // Collect order detail items
            const orderDetails = [];

            $('#editOrderDetailsContainer .order-detail').each(function() {
                const detail = {
                    description: $(this).find('textarea[name^="order_details"][name*="[description]"]')
                        .val(),
                    quantity: $(this).find('input[name^="order_details"][name*="[quantity]"]').val(),
                    price: $(this).find('input[name^="order_details"][name*="[price]"]').val(),
                    start_date: $(this).find('input[name^="order_details"][name*="[start_date]"]')
                    .val(),
                    end_date: $(this).find('input[name^="order_details"][name*="[end_date]"]').val(),
                    is_free: $(this).find('select[name^="order_details"][name*="[is_free]"]').val()
                };
                orderDetails.push(detail);
            });

            // Append meta_data JSON manually
            formData.append('meta_data', JSON.stringify(orderDetails));

            $.ajax({
                url: url,
                type: method,
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    Swal.fire("Updated!", response.message, "success");
                    $('#editModal').modal('hide');
                    $('#table').DataTable().ajax.reload(null, false);
                },
                error: function(xhr) {
                    Swal.fire("Error!", "Failed to update invoice.", "error");
                }
            });
        });



        let detailIndex = 1; // Initialize the detail index


        // Add Order Detail for both Create and Edit forms
        $('body').on('click', '#addItemContainer', function() {
            const containerId = '#itemContainer';

            const detailTemplate = `
                          <div class="order-detail mb-3">
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label">Description</label>
                        <textarea name="order_details[${detailIndex}][description]" class="form-control" ></textarea>
                    </div>
                    <div class="col-md-1">
                        <label class="form-label">Qty</label>
                        <input type="number" name="order_details[${detailIndex}][quantity]" class="form-control" >
                    </div>
                    <div class="col-md-1">
                        <label class="form-label">Price</label>
                        <input type="number" step="0.01" name="order_details[${detailIndex}][price]" class="form-control" >
                    </div>
                            <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="start_date[]" class="form-label">Start Date</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="ti ti-calendar fs-5"></i>
                                                </span>
                                                <input type="date" name="order_details[${detailIndex}][start_date]" id="start_date_0"
                                                    class="form-control pickadate-selectors picker__input start-date" placeholder="Start Date" required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="end_date[]" class="form-label">End Date</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="ti ti-calendar fs-5"></i>
                                                </span>
                                                <input type="date" name="order_details[${detailIndex}][end_date]" id="end_date_0"
                                                    class="form-control pickadate-selectors picker__input end-date" placeholder="End Date" required>
                                            </div>
                                        </div>
                                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Free Service</label>
                        <select name="order_details[${detailIndex}][is_free]" class="form-select">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="col-md-1 mt-4">
                        <button type="button" class="btn btn-danger removeOrderDetail"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </div>
            </div>
                `;

           // Append to container
           const $newDetail = $(detailTemplate);
            $(containerId).append($newDetail);

            // Initialize pickadate ONLY on new date pickers
            $newDetail.find('.pickadate-selectors').pickadate({
                labelMonthNext: "Next month",
                labelMonthPrev: "Previous month",
                labelMonthSelect: "Pick a Month",
                labelYearSelect: "Pick a Year",
                selectMonths: true,
                selectYears: true
            });
            detailIndex++;
        });

        // Remove Order Detail for both forms
        $('body').on('click', '.removeOrderDetail', function() {
            $(this).closest('.order-detail').remove();
        });
    </script>
@endsection
