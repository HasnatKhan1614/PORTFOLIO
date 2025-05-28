<?php $__env->startSection('content'); ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Student Edit</h3>
                    </div>
                    <div class="card-body">
                        <form id="form" action="<?php echo e(route('students.update', $student->id)); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <!-- Spoofing the PUT method as Laravel requires -->
                            <div class="row">


                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="sid">Student ID (SID)</label>
                                        <input type="text" id="sid" name="sid" value="<?php echo e($student->sid); ?>" class="form-control" placeholder="Enter Student ID" required>
                                    </div>
                                </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="campus">Select Campus</label>
                                            <select class="select2bs4 form-control" id="campus" name="campus"
                                                data-placeholder="Select Campus" style="width: 100%;">
                                                <option value="" disabled <?php echo e($student->campus == null ? 'selected' : ''); ?>>Select Campus</option>
                                                <option value="Johar" <?php echo e($student->campus == 'Johar' ? 'selected' : ''); ?>>Johar</option>
                                                <option value="North Nazimabad" <?php echo e($student->campus == 'North Nazimabad' ? 'selected' : ''); ?>>North Nazimabad</option>

                                            </select>

                                        </div>
                                    </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="class">Select Class</label>
                                        <select class="select2bs4 form-control" id="class" name="class" data-placeholder="Select Class" style="width: 100%;">
                                            <option value="" disabled <?php echo e($student->class == null ? 'selected' : ''); ?>>Select Class</option>
                                            <option value="Beginner" <?php echo e($student->class == 'Beginner' ? 'selected' : ''); ?>>Beginner</option>
                                            <option value="Junior" <?php echo e($student->class == 'Junior' ? 'selected' : ''); ?>>Junior</option>
                                            <option value="Grade 1" <?php echo e($student->class == 'Grade 1' ? 'selected' : ''); ?>>Grade 1</option>
                                            <option value="Grade 2" <?php echo e($student->class == 'Grade 2' ? 'selected' : ''); ?>>Grade 2</option>
                                            <option value="Grade 3" <?php echo e($student->class == 'Grade 3' ? 'selected' : ''); ?>>Grade 3</option>
                                            <option value="Grade 4 Girls" <?php echo e($student->class == 'Grade 4 Girls' ? 'selected' : ''); ?>>Grade 4 Girls</option>
                                            <option value="Grade 4 Boys" <?php echo e($student->class == 'Grade 4 Boys' ? 'selected' : ''); ?>>Grade 4 Boys</option>
                                            <option value="Senior" <?php echo e($student->class == 'Senior' ? 'selected' : ''); ?>>Senior</option>
                                            <option value="Hifz Boys" <?php echo e($student->class == 'Hifz Boys' ? 'selected' : ''); ?>>Hifz Boys</option>
                                            <option value="Hifz Girls" <?php echo e($student->class == 'Hifz Girls' ? 'selected' : ''); ?>>Hifz Girls</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" id="first_name" name="first_name" value="<?php echo e($student->first_name); ?>" class="form-control" placeholder="Enter First Name" required>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" id="last_name" name="last_name" value="<?php echo e($student->last_name); ?>" class="form-control" placeholder="Enter Last Name">
                                    </div>
                                </div>

                                                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="student_name">Student Name (as it will appear on card)</label>
                                            <input type="text" id="student_name" name="student_name" value="<?php echo e($student->student_name); ?>" class="form-control"
                                                placeholder="Student Name">

                                        </div>
                                    </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="father_name">Father's Name</label>
                                        <input type="text" id="father_name" name="father_name" value="<?php echo e($student->father_name); ?>" class="form-control" placeholder="Enter Father's Name">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input type="text" id="phone" name="phone" value="<?php echo e($student->phone); ?>" class="form-control" placeholder="Enter Phone Number">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="dob">Date of Birth</label>
                                        <input type="date" id="dob" name="dob" value="<?php echo e($student->dob); ?>" class="form-control" placeholder="Enter Date of Birth">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" id="address" name="address" value="<?php echo e($student->address); ?>" class="form-control" placeholder="Enter Address">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="is_registered">Allow Registrations</label>
                                        <select id="is_registered" name="is_registered" class="form-control">
                                            <option value="1" <?php echo e($student->is_registered == 0 ? 'selected' : ''); ?>>Yes</option>
                                            <option value="0" <?php echo e($student->is_registered == 1 ? 'selected' : ''); ?>>No</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="image">Upload Image</label>
                                        <input type="file" name="image" id="image" class="form-control-file" accept="image/*">

                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-secondary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Hasnat Khan\Desktop\kreatixsolutions\id-card\resources\views/pages/students/edit.blade.php ENDPATH**/ ?>