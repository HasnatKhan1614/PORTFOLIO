@extends('admin.layouts.app')

@section('content')
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
                            <a href="{{ route('admin.orders.index') }}">Orders</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Create
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card-body">

            <form id="createForm" action="{{ route('admin.custom-invoices.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="company_name" class="form-label">Company Name</label>
                                <input type="text" name="company_name" id="company_name" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="c_name" class="form-label">Customer Name</label>
                                <input type="text" name="c_name" id="c_name" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="c_email" class="form-label">Customer Email</label>
                                <input type="email" name="c_email" id="c_email" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="c_phone" class="form-label">Customer Phone</label>
                                <input type="text" name="c_phone" id="c_phone" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="c_address" class="form-label">Customer Address</label>
                                <textarea name="c_address" id="c_address" rows="3" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="notes" class="form-label">Notes</label>
                                <textarea class="form-control" name="notes" id="notes" cols="30" rows="5"></textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="currency" class="form-label">Currency</label>
                                <select class="form-select" name="currency">
                                    <option value="USD">USD</option>
                                    <option value="GBP">GBP</option>
                                    <option value="PKR">PKR</option>
                                    <option value="MYR">MYR</option>

                                </select>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="payment_status" class="form-label">Payment Status</label>
                                <select name="payment_status" id="payment_status" class="form-control">
                                    <option value="1">Paid</option>
                                    <option value="0">Unpaid</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="logo_image" class="form-label">Logo Image</label>
                                <input type="file" name="logo_image" id="logo_image" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Banks</label>

                                @foreach ($banks as $bank)
                                    <div class="col-md-4">
                                        <div class="mb-3 form-check">
                                            <input class="form-check-input" type="checkbox" name="bank_information_ids[]"
                                                value="{{ $bank->id }}" id="bank-{{ $bank->id }}">
                                            <label class="form-check-label" for="bank-{{ $bank->id }}">
                                                {{ $bank->bank_name }} - {{ $bank->account_number }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Appendable Order Details -->
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Order Details</h5>
                            <button type="button" class="btn btn-success" id="addOrderDetail">
                                <i class="fas fa-box-open"></i> <!-- Cart icon from Bootstrap -->
                            </button>
                        </div>
                        <div id="orderDetailsContainer">
                            <div class="order-detail mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="order_details[0][description]" class="form-label">Description</label>
                                        <textarea name="order_details[0][description]" class="form-control"
                                            required></textarea>
                                    </div>

                                    <div class="col-md-1">
                                        <label for="order_details[0][quantity]" class="form-label">Qty</label>
                                        <input type="number" name="order_details[0][quantity]" class="form-control"
                                            value="1" required>
                                    </div>

                                    <div class="col-md-1">
                                        <label for="order_details[0][price]" class="form-label">Price</label>
                                        <input type="number" step="0.01" name="order_details[0][price]"
                                            class="form-control" required>
                                    </div>

                                                                 <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="start_date_0" class="form-label">Start Date</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="ti ti-calendar fs-5"></i>
                                                </span>
                                                <input type="date" name="order_details[0][start_date]" id="start_date_0"
                                                    class="form-control pickadate-selectors picker__input start-date" placeholder="Start Date" required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="end_date_0" class="form-label">End Date</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="ti ti-calendar fs-5"></i>
                                                </span>
                                                <input type="date" name="order_details[0][end_date]" id="end_date_0"
                                                    class="form-control pickadate-selectors picker__input end-date" placeholder="End Date" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="order_details[0][is_free]" class="form-label">Free Service</label>
                                        <select name="order_details[0][is_free]" class="form-select">
                                            <option value="1">Yes</option>
                                            <option value="0" selected>No</option>
                                        </select>
                                    </div>

                                    <div class="col-md-1 mt-4">
                                        <button type="button" class="btn btn-danger removeOrderDetail">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary">Save Order</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Handle Form Submission (Create/Update)
        $('body').on('submit', '#createForm', function(event) {
            event.preventDefault();

            var form = $(this)[0];
            var url = $(this).attr('action');
            var method = $(this).attr('method');
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            var baseUrl = "{{ env('APP_URL') }}";

            let formData = new FormData(form);

            // Extract order details and append as meta_data
            const orderDetails = [];

            $('#orderDetailsContainer .order-detail').each(function() {
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

            // Remove existing meta_data if any, then append new one
            formData.delete('meta_data');
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
                    Swal.fire("Success!", response.message, "success");
                    $('#createForm')[0].reset();
                    $('#createForm').closest('.modal').modal('hide');
                    window.location = baseUrl + '/admin/custom-invoices/invoice/' + response.orderId;
                },
                error: function(xhr) {
                    Swal.fire("Error!", "Failed to submit data.", "error");
                }
            });
        });



        // Add Order Detail for both Create and Edit forms
        $('body').on('click', '#addOrderDetail', function() {
            const containerId = '#orderDetailsContainer';

            const detailTemplate = `
                               <div class="order-detail mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="order_details[0][description]" class="form-label">Description</label>
                                        <textarea name="order_details[0][description]" class="form-control"
                                            required></textarea>
                                    </div>

                                    <div class="col-md-1">
                                        <label for="order_details[0][quantity]" class="form-label">Qty</label>
                                        <input type="number" name="order_details[0][quantity]" class="form-control"
                                            value="1" required>
                                    </div>

                                    <div class="col-md-1">
                                        <label for="order_details[0][price]" class="form-label">Price</label>
                                        <input type="number" step="0.01" name="order_details[0][price]"
                                            class="form-control" required>
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
                                        <label for="order_details[0][is_free]" class="form-label">Free Service</label>
                                        <select name="order_details[0][is_free]" class="form-select">
                                            <option value="1">Yes</option>
                                            <option value="0" selected>No</option>
                                        </select>
                                    </div>

                                    <div class="col-md-1 mt-4">
                                        <button type="button" class="btn btn-danger removeOrderDetail">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
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
