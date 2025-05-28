<?php $__env->startSection('content'); ?>
    <div id="content" class="main-content">
        <div class="container">
            <div class="container">
                <!-- resources/views/livewire/payments-create-or-edit.blade.php -->
                <div class="row">
                    <div id="flFormsGrid" class="col-lg-12 layout-spacing layout-top-spacing ">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Create Payment Link</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area custom-overlay">
                                <form id="createPaymentForm">
                                    <!-- Customer Type and Existing Customer Dropdown -->
                                    <div class="form-row mb-4">
                                        <div class="form-group col-md-12">
                                            <label for="customer_type">Customer Type</label>
                                            <select class="form-control" id="customer_type" name="customer_type">
                                                <option value="0" selected>Existing Customer</option>
                                                <option value="1">New Customer</option>
                                            </select>
                                        </div>

                                        <!-- Existing Customer Dropdown -->
                                        <div class="form-group col-md-12" id="existing_customer_fields">
                                            <label for="customer_id">Select Customer <span style="color: red;">*</span></label>
                                            <select class="form-control" id="customer_id" name="customer_id">
                                                <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($customer->id); ?>"><?php echo e($customer->first_name); ?>

                                                        <?php echo e($customer->last_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <span class="text-danger error-message" id="customer_id_error"></span>
                                        </div>
                                    </div>

                                    <!-- New Customer Fields (Hidden by Default) -->
                                    <div id="new_customer_fields" style="display: none;">
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-6">
                                                <label for="first_name">First Name <span style="color: red;">*</span></label>

                                                <input type="text" class="form-control" id="first_name" name="first_name"
                                                    placeholder="First Name">
                                                <span class="text-danger error-message" id="first_name_error"></span>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="last_name">Last Name <span style="color: gray;">(optional)</span></label>
                                                <input type="text" class="form-control" id="last_name" name="last_name"
                                                    placeholder="Last Name">
                                                <span class="text-danger error-message" id="last_name_error"></span>
                                            </div>
                                        </div>
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-6">
                                                <label for="phone_number">Phone Number <span style="color: gray;">(optional)</span></label>
                                                <input type="text" class="form-control" id="phone_number"
                                                    name="phone_number" placeholder="Phone Number">
                                                <span class="text-danger error-message" id="phone_number_error"></span>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="email">Email Address <span style="color: gray;">(optional)</span></label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="Email Address">
                                                <span class="text-danger error-message" id="email_error"></span>
                                            </div>
                                        </div>




                                    </div>

                                    <!-- Gateway and Brand Selection -->
                                    <div class="form-row mb-4">
                                        <div class="form-group col-md-6">
                                            <label for="gateway_id">Gateway <span style="color: red;">*</span></label>
                                            <select class="form-control" id="gateway_id" name="gateway_id">
                                                <?php $__currentLoopData = $gateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($gateway->id); ?>"><?php echo e($gateway->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <span class="text-danger error-message" id="gateway_id_error"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="brand_id">Brand <span style="color: red;">*</span></label>
                                            <select class="form-control" id="brand_id" name="brand_id">
                                                <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($brand->id); ?>"><?php echo e($brand->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <span class="text-danger error-message" id="brand_id_error"></span>
                                        </div>
                                    </div>

                                    <!-- Invoice Number and Package Name -->
                                    <div class="form-row mb-4">
                                        
                                        <div class="form-group col-md-12">
                                            <label for="package_name">Package Name <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" id="package_name" name="package_name"
                                                placeholder="Package Name">
                                            <span class="text-danger error-message" id="package_name_error"></span>
                                        </div>
                                    </div>

                                    <!-- Description and Currency -->
                                    <div class="form-row mb-4">
                                        <div class="form-group col-md-6">
                                            <label for="description">Description <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" id="description"
                                                name="description" placeholder="Description">
                                            <span class="text-danger error-message" id="description_error"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="currency">Currency <span style="color: red;">*</span></label>
                                            <select class="form-control" id="currency" name="currency">
                                                <option value="usd" selected>USD</option>
                                                <option value="gbp">GBP</option>
                                            </select>
                                            <span class="text-danger error-message" id="currency_error"></span>
                                        </div>
                                    </div>

                                    <!-- Price and Tax -->
                                    <div class="form-row mb-4">
                                        <div class="form-group col-md-6">
                                            <label for="price">Price <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" id="price" name="price"
                                                placeholder="Price">
                                            <span class="text-danger error-message" id="price_error"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="tax">Tax (%) <span style="color: red;">*</span></label>
                                            <input type="number" class="form-control" id="tax" name="tax"
                                                placeholder="Tax" value="0">
                                            <span class="text-danger error-message" id="tax_error"></span>
                                        </div>
                                    </div>

                                    <!-- Remaining and Submit Button -->
                                    <div class="form-row mb-4">
                                        <div class="form-group col-md-6">
                                            <label for="remaining">Remaining <span style="color: red;">*</span></label>
                                            <input type="number" class="form-control" id="remaining" name="remaining"
                                                placeholder="Remaining" value="0">
                                            <span class="text-danger error-message" id="remaining_error"></span>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="form-row mb-4">
                                        <div class="form-group col-md-12">
                                            <button type="button" id="submitBtn" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function() {
            // Set CSRF token for all AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#submitBtn').click(function(e) {
                e.preventDefault();


                $.blockUI({
                    message: 'Loading....',
                    fadeIn: 800,
                    overlayCSS: {
                        backgroundColor: '#1b2024',
                        opacity: 0.8,
                        zIndex: 1200,
                        cursor: 'wait'
                    },
                    css: {
                        border: 0,
                        color: '#fff',
                        zIndex: 1201,
                        padding: 0,
                        backgroundColor: 'transparent'
                    },
                    onBlock: function() {}
                });

                $.ajax({
                    type: 'POST',
                    url: '/payments',
                    data: $('#createPaymentForm').serialize(),
                    success: function(response) {
                        // Clear form fields
                        $('#createPaymentForm')[0].reset();

                        // Show Snackbar notification
                        Snackbar.show({
                            text: 'Payment Link created successfully.',
                            duration: 5000, // 5 seconds
                        });

                        // Redirect after 2 seconds
                        setTimeout(function() {
                            $.unblockUI();
                            window.location.href = response.link;
                        }, 2000);
                    },
                    error: function(xhr) {
                        var err = JSON.parse(xhr.responseText);
                        console.log('Error:', err);

                        // Display validation errors
                        $.each(err.errors, function(key, value) {
                            $('#' + key + '_error').text(value);
                        });

                        // Unblock the loader after error handling
                        $(block).unblock();
                    }
                });
            });

        });
    </script>
    <!-- JavaScript to Toggle New Customer Fields -->
    <script>
        document.getElementById('customer_type').addEventListener('change', function() {
            var existingCustomerFields = document.getElementById('existing_customer_fields');
            var newCustomerFields = document.getElementById('new_customer_fields');

            if (this.value === '1') {
                // Show new customer fields and hide existing customer dropdown
                newCustomerFields.style.display = 'block';
                existingCustomerFields.style.display = 'none';
            } else {
                // Show existing customer dropdown and hide new customer fields
                newCustomerFields.style.display = 'none';
                existingCustomerFields.style.display = 'block';
            }
        });
    </script>
    <script>
        var block = $('#custom-overlay');
        $(block).block({
            message: 'Loading....',
            timeout: 2000, //unblock after 2 seconds
            overlayCSS: {
                backgroundColor: '#515365',
                opacity: 0.9,
                cursor: 'wait'
            },
            css: {
                border: 0,
                padding: 0,
                color: '#fff',
                backgroundColor: 'transparent'
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Hasnat Khan\Desktop\sideprojects\mypayportal\resources\views/payment/create.blade.php ENDPATH**/ ?>