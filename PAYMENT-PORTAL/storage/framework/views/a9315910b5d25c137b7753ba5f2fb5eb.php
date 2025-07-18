<?php $__env->startSection('content'); ?>
    <div id="content" class="main-content">
        <div class="container">
            <div class="container">
                <!-- resources/views/livewire/gateways-create-or-edit.blade.php -->
                <div class="row">
                    <div id="flFormsGrid" class="col-lg-12 layout-spacing layout-top-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Create Gateway</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <form id="editGatewayForm">
                                    <div class="form-row mb-4">
                                        <label for="name">Type</label>
                                        <select name="type" id="type" class="form-control">
                                            <option value="stripe" <?php echo e($gateway->type == 'stripe' ? 'selected' : ''); ?>>Stripe</option>
                                            <option value="paypal" <?php echo e($gateway->type == 'paypal' ? 'selected' : ''); ?>>Paypal</option>
                                        </select>
                                        <span class="text-danger error-message" id="name_error"></span>
                                    </div>
                                    <div class="form-row mb-4">
                                        <input id="gateway_id" type="hidden" value="<?php echo e($gateway->id); ?>">
                                        <div class="form-group col-md-12">
                                            <label for="name">Name</label>
                                            <input value="<?php echo e($gateway->name); ?>" type="text" class="form-control"
                                                id="name" name="name" placeholder="First Name">
                                            <span class="text-danger error-message" id="name_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-row mb-4">
                                        <div class="form-group col-md-12">
                                            <label for="key1">KEY 1</label>
                                            <input value="<?php echo e($gateway->key1); ?>" type="text" class="form-control"
                                                id="key1" name="key1" placeholder="First Name">
                                            <span class="text-danger error-message" id="key1_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-row mb-4">
                                        <div class="form-group col-md-12">
                                            <label for="key2">KEY 2</label>
                                            <input value="<?php echo e($gateway->key2); ?>" type="text" class="form-control"
                                                id="key2" name="key2" placeholder="First Name">
                                            <span class="text-danger error-message" id="key2_error"></span>
                                        </div>
                                    </div>
                                    <button type="button" id="updateBtn" class="btn btn-primary mt-3">Save Gateway</button>
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

            $('#updateBtn').click(function() {
                var gatewayId = $('#gateway_id').val(); // Get gateway ID from hidden field
                console.log(gatewayId)
                $.ajax({
                    type: 'PUT', // Use PUT method for update
                    url: '/gateways/' + gatewayId, // Update the URL to include gateway ID
                    data: $('#editGatewayForm').serialize(),
                    success: function(response) {
                        // Show Snackbar notification
                        Snackbar.show({
                            text: 'Gateway updated successfully.',
                            duration: 5000, // 5 seconds
                        });
                    },
                    error: function(xhr, status, error) {
                        var err = JSON.parse(xhr.responseText);
                        console.log('Error:', err);

                        // Display validation errors
                        $.each(err.errors, function(key, value) {
                            $('#' + key + '_error').text(value);
                        });
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Hasnat Khan\Desktop\sideprojects\mypayportal\resources\views/gateway/edit.blade.php ENDPATH**/ ?>