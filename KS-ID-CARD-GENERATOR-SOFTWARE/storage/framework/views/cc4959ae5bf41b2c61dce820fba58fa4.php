<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-body d-flex">
                            <div class="row">
                                <a href="<?php echo e(route('students.registration')); ?>" class="btn btn-secondary mx-2">All Registrations</a>

                            </div>



                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Students</h3>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered" id="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Class Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            // DataTable initialization
            var dataTable = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "<?php echo e(route('students.class.list')); ?>",
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    }, // Index column
                    {
                        data: 'class_name',
                        name: 'class_name'
                    }, // Class name column
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }, // Action column
                ]
            });

        });

        // Handle click event for the View button
        $(document).on('click', '.view', function(e) {
            e.preventDefault();
            var classFilter = $(this).data('class'); // Assuming class is stored in the data attribute
            window.location.href = "<?php echo e(route('students.registration')); ?>?class_filter=" + classFilter;
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\D-tek.DESKTOP-TKC8L0H\Desktop\n\id-card\resources\views/pages/students/class-list.blade.php ENDPATH**/ ?>