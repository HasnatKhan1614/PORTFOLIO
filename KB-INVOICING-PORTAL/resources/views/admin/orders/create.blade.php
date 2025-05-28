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
                        Create
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

            <form id="createForm" action="{{ route('admin.orders.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="user_id" class="form-label">User</label>
                            <select name="user_id" class="form-select">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="domain" class="form-label">Domain</label>
                                <input type="text" name="domain" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="payment_interval" class="form-label">Payment Interval</label>
                                <select class="form-select payment-interval" name="payment_interval">
                                    <option value="payment">One-time</option>
                                    <option value="mo">Monthly</option>
                                    <option value="yr">Yearly</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="currency" class="form-label">Currency</label>
                                <select name="currency" class="form-select">
                                    <option value="USD">USD</option>
                                    <option value="GBP">GBP</option>
                                    <option value="PKR">PKR</option>
                                    <option value="MYR">MYR</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="payment_type" class="form-label">Payment Type</label>
                                <select name="payment_type" id="payment_type" class="form-select">
                                    <option value="">-- Select Payment Type --</option>
                                    <option value="cash">Cash</option>
                                    <option value="stripe">Stripe</option>
                                    <option value="bank_transfer">Bank Transfer</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="tax_type" class="form-label">Tax Type</label>
                                <select name="tax_type" id="tax_type" class="form-select">
                                    <option value="">-- Select Tax Type --</option>
                                    <option value="percent">Percent</option>
                                    <option value="amount">Amount</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="tax_value" class="form-label">Tax Value</label>
                                <input type="number" step="0.01" name="tax_value" id="tax_value" class="form-control"
                                    placeholder="Enter tax value">
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="domain" class="form-label">Notes</label>
                                <textarea class="form-control" name="notes" id="notes" cols="30" rows="10"></textarea>
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
                            <!-- Template for the first product -->
                            <div class="order-detail mb-3">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="product_id[]" class="form-label">Product</label>
                                        <select name="order_details[0][product_id]" class="form-select">
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <label for="quantity[]" class="form-label">Quantity</label>
                                        <input type="number" name="order_details[0][quantity]" class="form-control"
                                            value="1" required>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="price_0" class="form-label">Price</label>
                                            <input type="number" step="0.01" name="order_details[0][price]" id="price_0"
                                                class="form-control" required>
                                        </div>
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
                                        <label for="is_free[]" class="form-label">Free Service</label>
                                        <select name="order_details[0][is_free]" class="form-select">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1 mt-4">
                                        <button type="button" class="btn btn-danger removeOrderDetail">
                                            <i class="fas fa-trash-alt"></i> <!-- Trash icon -->
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
        $(document).ready(function() {

            function formatDate(date) {
                return date.toISOString().split('T')[0];
            }

            function calculateDates($row, interval) {
                const today = new Date();
                let endDate = new Date(today);

                if (interval === 'mo') {
                    endDate.setMonth(endDate.getMonth() + 1);
                } else if (interval === 'yr') {
                    endDate.setFullYear(endDate.getFullYear() + 1);
                }

                $row.find('.start-date').val(formatDate(today));
                $row.find('.end-date').val(formatDate(endDate));
            }

            // On click of an option in the select
            $(document).on('click', '.payment-interval', function() {
                const interval = $(this).val();
                const $select = $(this).closest('select');
                const $row = $select.closest('.row');
                console.log(interval);
                console.log($select);
                console.log($row);

                if (interval === 'mo' || interval === 'yr') {
                    calculateDates($row, interval);
                } else {
                    // If one-time or anything else, clear fields
                    $row.find('.start-date, .end-date').val('');
                }
            });
        });
    </script>




    <script>
        // Handle Form Submission (Create/Update)
        $('body').on('submit', '#createForm', function(event) {
            event.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var method = form.attr('method');
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            var baseUrl = "{{ env('APP_URL') }}";


            $.ajax({
                url: url,
                type: method,
                data: form.serialize(),
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    Swal.fire("Success!", response.message, "success");
                    form.closest('.modal').modal('hide');
                    form[0].reset();
                    window.location = baseUrl + '/admin/invoice/' + response.orderId + '/initial';

                },
                error: function(xhr) {
                    Swal.fire("Error!", "Failed to submit data.", "error");
                }
            });
        });

        let detailIndex = 1; // Initialize the detail index


        // Add Order Detail for both Create and Edit forms
        $('body').on('click', '#addOrderDetail', function() {
            const containerId = '#orderDetailsContainer';

            const detailTemplate = `
                    <div class="order-detail mb-3">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="product_id[]" class="form-label">Product</label>
                                <select name="order_details[${detailIndex}][product_id]" class="form-select">
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1">
                                <label for="quantity[]" class="form-label">Quantity</label>
                                <input type="number" name="order_details[${detailIndex}][quantity]" class="form-control" value="1" required>
                            </div>
                            <div class="col-md-2">
                                <label for="price[]" class="form-label">Price</label>
                                <input type="number" step="0.01" name="order_details[${detailIndex}][price]" class="form-control" required>
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
                                <label for="is_free[]" class="form-label">Free?</label>
                                <select name="order_details[${detailIndex}][is_free]" class="form-select">
                                    <option value="1">Yes</option>
                                    <option value="0" selected>No</option>
                                </select>
                            </div>
                            <div class="col-md-1 mt-4">
                                <button type="button" class="btn btn-danger removeOrderDetail">
                                    <i class="fas fa-trash-alt"></i> <!-- Trash icon -->
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
