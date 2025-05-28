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
                </ol>
            </nav>
        </div>
    </div> --}}

    <div class="datatables">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="fw-semibold mb-0">Orders</h4>
                            <a href="{{ route('admin.orders.create') }}"
                                class="btn me-1 mb-1 bg-primary-subtle text-primary px-4 fs-4 ">Create</a>
                        </div>
                        <div class="table-responsive">
                            <table id="table"
                                class="table border w-100 table-striped table-bordered display text-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Domain</th>
                                        <th>Invoice Number</th>
                                        <th>Email</th>
                                        <th>Products</th>
                                        <th>Amount</th>
                                        <th>Type</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Expire In</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end File export -->
            </div>
        </div>

    </div>

    <!-- Create Order Modal -->
    {{-- <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form id="createForm" action="{{ route('admin.orders.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Create Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
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
                                    <select name="payment_interval" class="form-select">
                                        <option value="mo">Monthly</option>
                                        <option value="yr">Yearly</option>
                                        <option value="payment">One-time</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="domain" class="form-label">Notes</label>
                                    <textarea class="form-control" name="notes" id="notes" cols="30" rows="10"></textarea>
                                </div>
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
                                    <div class="col-md-4">
                                        <label for="product_id[]" class="form-label">Product</label>
                                        <select name="order_details[0][product_id]" class="form-select">
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="quantity[]" class="form-label">Quantity</label>
                                        <input type="number" name="order_details[0][quantity]" class="form-control"
                                            value="1" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="price[]" class="form-label">Price</label>
                                        <input type="number" step="0.01" name="order_details[0][price]"
                                            class="form-control" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="is_free[]" class="form-label">Free?</label>
                                        <select name="is_free[]" class="form-select">
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
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

    <!-- Edit Order Modal -->
    {{-- <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form id="editForm" action="{{ route('admin.orders.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Create Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
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
                                    <select name="payment_interval" class="form-select">
                                        <option value="mo">Monthly</option>
                                        <option value="yr">Yearly</option>
                                        <option value="payment">One-time</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="domain" class="form-label">Notes</label>
                                    <textarea class="form-control" name="notes" id="notes" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Appendable Order Details -->
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Order Details</h5>
                            <button type="button" class="btn btn-success" id="addOrderDetailEdit">
                                <i class="fas fa-box-open"></i> <!-- Cart icon from Bootstrap -->
                            </button>
                        </div>
                        <div id="orderDetailsContainerEdit">
                            <!-- Template for the first product -->
                            <div class="order-detail mb-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="product_id[]" class="form-label">Product</label>
                                        <select name="order_details[0][product_id]" class="form-select">
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="quantity[]" class="form-label">Quantity</label>
                                        <input type="number" name="order_details[0][quantity]" class="form-control"
                                            value="1" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="price[]" class="form-label">Price</label>
                                        <input type="number" step="0.01" name="order_details[0][price]"
                                            class="form-control" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="is_free[]" class="form-label">Free?</label>
                                        <select name="is_free[]" class="form-select">
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
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
@endsection

@section('script')
<script>
    $(document).on('click', '.change-payment-status', function () {
        var button = $(this);
        var orderId = button.data('id');
        var currentStatus = button.data('status');

        var nextStatus = currentStatus === 'paid' ? 'unpaid' : 'paid';

        $.ajax({
            url: "{{ route('admin.orders.togglePaymentStatus', ':id') }}".replace(':id', orderId),
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: nextStatus
            },
            success: function (res) {
                if (res.success) {
                    // ✅ Update the button text and data-status
                    button.data('status', res.new_status);

                    const icon = button.find('i');
                    const newText = ' Mark as ' + (res.new_status === 'paid' ? 'Unpaid' : 'Paid');
                    button.html(icon.prop('outerHTML') + newText);

                    // ✅ Update payment_status badge in the same row
                    const badgeClass = res.new_status === 'paid' ? 'bg-success' : 'bg-warning';
                    const badgeText = res.new_status.charAt(0).toUpperCase() + res.new_status.slice(1);

                    // Assuming you’re in a table row, find the related column
                    const row = button.closest('tr');
                    row.find('td').each(function () {
                        // Look for cell with payment badge
                        if ($(this).find('.badge').length && $(this).find('.badge').text().match(/Paid|Unpaid/i)) {
                            $(this).html('<span class="badge ' + badgeClass + '">' + badgeText + '</span>');
                        }
                    });
                } else {
                    alert('Failed to update payment status.');
                }
            }
        });
    });
</script>



    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var dataTable = $('#table').DataTable({
                ordering: false,
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.orders.index') }}",
                scrollX: true,

                columns: [

                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'domain',
                        name: 'domain'
                    },
                    {
                        data: 'invoice_number',
                        name: 'invoice_number'
                    },
                    {
                        data: 'user_email',
                        name: 'user_email'
                    },
                    {
                        data: 'products',
                        name: 'products'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'payment_status',
                        name: 'payment_status'
                    },
                    {
                        data: 'expire_in',
                        name: 'expire_in'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });


            // Show Edit Modal and Load Data
            // $('body').on('click', '.edit', function() {
            //     var id = $(this).data('id');
            //     var url = "{{ route('admin.orders.edit', ':id') }}".replace(':id', id);

            //     // AJAX call to fetch the data
            //     $.ajax({
            //         url: url,
            //         type: 'GET',
            //         success: function(response) {
            //             var form = $('#editForm');
            //             // Populate the form with the fetched data
            //             form.find('input[name="user_id"]').val(response.user_id);
            //             form.find('input[name="domain"]').val(response.domain);
            //             form.find('select[name="payment_interval"]').val(response
            //                 .payment_interval);
            //             form.find('textarea[name="notes"]').val(response.notes);

            //             // Populate order details
            //             var orderDetailsContainerEdit = form.find('#orderDetailsContainerEdit');
            //             orderDetailsContainerEdit.empty(); // Clear any existing details
            //             response.order_details.forEach(function(detail, index) {
            //                 const detailTemplate = `
        //                 <div class="order-detail mb-3">
        //                     <div class="row">
        //                         <div class="col-md-4">
        //                             <label for="product_id[]" class="form-label">Product</label>
        //                             <select name="order_details[${index}][product_id]" class="form-select">
        //                                 @foreach ($products as $product)
        //                                 <option value="{{ $product->id }}" ${detail.product_id == {{ $product->id }} ? 'selected' : ''}>
        //                                     {{ $product->name }}
        //                                 </option>
        //                                 @endforeach
        //                             </select>
        //                         </div>
        //                         <div class="col-md-2">
        //                             <label for="quantity[]" class="form-label">Quantity</label>
        //                             <input type="number" name="order_details[${index}][quantity]" class="form-control" value="${detail.quantity}" required>
        //                         </div>
        //                         <div class="col-md-3">
        //                             <label for="price[]" class="form-label">Price</label>
        //                             <input type="number" step="0.01" name="order_details[${index}][price]" class="form-control" value="${detail.price}" required>
        //                         </div>
        //                         <div class="col-md-2">
        //                             <label for="is_free[]" class="form-label">Free?</label>
        //                             <select name="order_details[${index}][is_free]" class="form-select">
        //                                 <option value="1">Yes</option>
        //                                 <option value="0" selected>No</option>
        //                             </select>
        //                         </div>

        //                         <div class="col-md-1 mt-4">
        //                             <button type="button" class="btn btn-danger removeOrderDetail">
        //                                 <i class="fas fa-trash-alt"></i> <!-- Trash icon -->
        //                             </button>
        //                         </div>
        //                     </div>
        //                 </div>`;
            //                 orderDetailsContainerEdit.append(detailTemplate);
            //             });

            //             // Update form action and method
            //             form.attr('action', "{{ route('admin.orders.update', ':id') }}"
            //                 .replace(':id', id));
            //             form.attr('method', 'PUT');

            //             // Show the modal
            //             $('#editModal').modal('show');
            //         },
            //         error: function() {
            //             Swal.fire("Error!", "Unable to load data. Please try again.", "error");
            //         }
            //     });
            // });

            // Handle Form Submission (Create/Update)
            // $('body').on('submit', '#createForm, #editForm', function(event) {
            //     event.preventDefault();

            //     var form = $(this);
            //     var url = form.attr('action');
            //     var method = form.attr('method');
            //     const csrfToken = $('meta[name="csrf-token"]').attr('content');

            //     $.ajax({
            //         url: url,
            //         type: method
            //             .toUpperCase(), // Ensure the method is in uppercase (POST, PUT, etc.)
            //         data: form.serialize(), // Serializes the form's elements.
            //         headers: {
            //             'X-CSRF-TOKEN': csrfToken // CSRF token for Laravel security
            //         },
            //         success: function(response) {
            //             Swal.fire("Success!", response.message, "success");
            //             form.closest('.modal').modal('hide'); // Hide the modal
            //             form[0].reset(); // Reset the form
            //             if (typeof dataTable !== 'undefined') {
            //                 dataTable.ajax.reload(); // Reload the DataTable if defined
            //             }
            //         },
            //         error: function(xhr) {
            //             // Handle validation errors or other server-side errors
            //             if (xhr.status === 422) { // Laravel validation error code
            //                 var errors = xhr.responseJSON.errors;
            //                 var errorMessages = '';
            //                 $.each(errors, function(key, value) {
            //                     errorMessages += value +
            //                         '\n'; // Aggregate error messages
            //                 });
            //                 Swal.fire("Validation Error", errorMessages, "error");
            //             } else {
            //                 Swal.fire("Error!", "Failed to submit data. Please try again.",
            //                     "error");
            //             }
            //         }
            //     });
            // });


            // let detailIndex = 0; // Initialize the detail index

            // Add Order Detail for both Create and Edit forms
            // $('body').on('click', '#addOrderDetail, #addOrderDetailEdit', function() {
            //     const isEdit = $(this).attr('id') ===
            //         'addOrderDetailEdit'; // Check if it's for the Edit form
            //     const containerId = isEdit ? '#orderDetailsContainerEdit' : '#orderDetailsContainer';

            //     const detailTemplate = `
        //         <div class="order-detail mb-3">
        //             <div class="row">
        //                 <div class="col-md-4">
        //                     <label for="product_id[]" class="form-label">Product</label>
        //                     <select name="order_details[${detailIndex}][product_id]" class="form-select">
        //                         @foreach ($products as $product)
        //                             <option value="{{ $product->id }}">{{ $product->name }}</option>
        //                         @endforeach
        //                     </select>
        //                 </div>
        //                 <div class="col-md-2">
        //                     <label for="quantity[]" class="form-label">Quantity</label>
        //                     <input type="number" name="order_details[${detailIndex}][quantity]" class="form-control" value="1" required>
        //                 </div>
        //                 <div class="col-md-3">
        //                     <label for="price[]" class="form-label">Price</label>
        //                     <input type="number" step="0.01" name="order_details[${detailIndex}][price]" class="form-control" required>
        //                 </div>
        //                 <div class="col-md-2">
        //                     <label for="is_free[]" class="form-label">Free?</label>
        //                     <select name="order_details[${detailIndex}][is_free]" class="form-select">
        //                         <option value="1">Yes</option>
        //                         <option value="0" selected>No</option>
        //                     </select>
        //                 </div>
        //                 <div class="col-md-1 mt-4">
        //                     <button type="button" class="btn btn-danger removeOrderDetail">
        //                         <i class="fas fa-trash-alt"></i> <!-- Trash icon -->
        //                     </button>
        //                 </div>
        //             </div>
        //         </div>
        //     `;

            //     $(containerId).append(detailTemplate); // Append to the appropriate container
            //     detailIndex++;
            // });

            // Remove Order Detail for both forms
            // $('body').on('click', '.removeOrderDetail', function() {
            //     $(this).closest('.order-detail').remove();
            // });

            // Handle Delete
            $('body').on('click', '.delete', function() {
                var id = $(this).data('id');
                var url = "{{ route('admin.orders.destroy', ':id') }}".replace(':id', id);

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'POST', // Use POST for compatibility
                            data: {
                                _method: 'DELETE', // Specify DELETE method for Laravel
                                _token: $('meta[name="csrf-token"]').attr(
                                    'content') // Include CSRF token
                            },
                            success: function(response) {
                                Swal.fire("Deleted!", response.message, "success");
                                if (typeof dataTable !== 'undefined') {
                                    dataTable.ajax
                                        .reload(); // Reload the DataTable if it exists
                                }
                            },
                            error: function(xhr) {
                                Swal.fire("Error!", "Failed to delete.", "error");
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
