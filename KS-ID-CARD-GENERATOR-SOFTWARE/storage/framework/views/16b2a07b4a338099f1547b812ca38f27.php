<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Student Create</h3>
                        </div>
                        <div class="card-body">
                            <form id="form" action="<?php echo e(route('students.store')); ?>" method="POST" data-method="POST"
                                data-method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="sid">Student ID (SID)</label>
                                            <input type="text" id="sid" name="sid" class="form-control"
                                                placeholder="Enter Student ID" required>

                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="campus">Select Campus</label>
                                            <select class="select2bs4 form-control" id="campus" name="campus"
                                                data-placeholder="Select Campus" style="width: 100%;">
                                                <option value="" disabled>Select Campus</option>
                                                <option value="Johar">Johar</option>
                                                <option value="North Nazimabad">North Nazimabad</option>

                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="class">Select Class</label>
                                            <select class="select2bs4 form-control" id="class" name="class"
                                                data-placeholder="Select Class" style="width: 100%;">
                                                <option value="" disabled selected>Select Class</option>
                                                <option value="Beginner">Beginner</option>
                                                <option value="Junior">Junior</option>
                                                <option value="Grade 1">Grade 1</option>
                                                <option value="Grade 2">Grade 2</option>
                                                <option value="Grade 3">Grade 3</option>
                                                <option value="Grade 4 Girls">Grade 4 Girls</option>
                                                <option value="Grade 4 Boys">Grade 4 Boys</option>
                                                <option value="Senior">Senior</option>
                                                <option value="Hifz Boys">Hifz Boys</option>
                                                <option value="Hifz Girls">Hifz Girls</option>

                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="first_name">First Name</label>
                                            <input type="text" id="first_name" name="first_name" class="form-control"
                                                placeholder="Enter First Name" required>

                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" id="last_name" name="last_name" class="form-control"
                                                placeholder="Enter Last Name">

                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="student_name">Student Name (as it will appear on card)</label>
                                            <input type="text" id="student_name" name="student_name" class="form-control"
                                                placeholder="Student Name">

                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="father_name">Father's Name</label>
                                            <input type="text" id="father_name" name="father_name" class="form-control"
                                                placeholder="Enter Father's Name">

                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="phone">Phone Number</label>
                                            <input type="text" id="phone" name="phone" class="form-control"
                                                placeholder="Enter Phone Number">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="dob">Date of Birth</label>
                                            <input type="date" id="dob" name="dob" class="form-control"
                                                placeholder="Enter Date of Birth">

                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" id="address" name="address" class="form-control"
                                                placeholder="Enter Address">

                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="is_registered">Allow Registrations</label>
                                            <select id="is_registered" name="is_registered" class="form-control">
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="image">Upload Image</label>
                                            <input type="file" id="image" name="image"
                                                class="form-control-file" accept="image/*">

                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-secondary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Hasnat Khan\Desktop\kreatixsolutions\id-card\resources\views/pages/students/create.blade.php ENDPATH**/ ?>