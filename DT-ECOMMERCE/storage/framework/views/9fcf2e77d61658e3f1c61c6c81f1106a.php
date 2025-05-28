
<?php $__env->startSection('content'); ?>

<?php
$types = App\Models\Variation::select('type', 'name')->get();

$formattedTypes = $types->groupBy('type')->map(function ($group) {
    return [
        'type' => $group->first()->type,
        'names' => $group->pluck('name')->toArray(),
    ];
})->values()->toArray();
?>

<div class="row mb-5">
  <div class="col-md-12 col-lg-12">

          <div class="card">
            <div class="card-body ">
              <div class="py-3">
                <form id="galleryForm" enctype="multipart/form-data" action="<?php echo e(route('gallery.store')); ?>" method="POST">
                  <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="vehicle_details" class="form-label">Vehicle Details</label>
                                <textarea class="form-control" name="vehicle_details" id="vehicle_details" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="year" class="form-label">Year</label>
                                <select class="form-select" id="yearSelect" name="year">
                                    <option value="">Select Year</option>
                                    <?php
                                    $currentYear = date('Y');
                                    ?>
                                    <?php for($year = $currentYear; $year >= 1923; $year--): ?>
                                        <option value="<?php echo e((int)$year); ?>"><?php echo e($year); ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="make" class="form-label">Make</label>
                                <select class="form-select" id="makeSelect" name="make">
                                    <option value="">Select Make</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="model" class="form-label">Model</label>
                                <select class="form-select" id="modelSelect" name="model">
                                    <option value="">Select Model</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="drive" class="form-label">Drive</label>
                                <select class="form-select" name="drive">
                                    <option value="">Select Drive</option>
                                    <option value="FWD">FWD</option>
                                    <option value="RWD">RWD</option>
                                    <option value="AWD">AWD</option>
                                    <option value="4WD">4WD</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="rubbing" class="form-label">Rubbing</label>
                                <select class="form-select" name="rubbing">
                                    <option value="">Select Rubbing</option>
                                    <?php $__currentLoopData = $formattedTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($type['type'] === 'Rubbing'): ?>
                                            <?php $__currentLoopData = $type['names']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($name); ?>"><?php echo e($name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="modification" class="form-label">Modification</label>
                                <select class="form-select" name="modification">
                                    <option value="">Select Modification</option>
                                    <?php $__currentLoopData = $formattedTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($type['type'] === 'Modification'): ?>
                                            <?php $__currentLoopData = $type['names']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($name); ?>"><?php echo e($name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="spacers" class="form-label">Spacers</label>
                                <select class="form-select" name="spacers" id="">
                                    <option value="">Select Spacers</option>
                                    <?php $__currentLoopData = $formattedTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($type['type'] === 'Spacers'): ?>
                                            <?php $__currentLoopData = $type['names']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($name); ?>"><?php echo e($name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="front_wheel_spacers" class="form-label">Front Wheel Spacer</label>
                                <input type="text" class="form-control" id="front_wheel_spacers" name="front_wheel_spacers" placeholder="Front Wheel Spacer">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="rear_wheel_spacers" class="form-label">Rear Wheel Spacer</label>
                                <input type="text" class="form-control" id="rear_wheel_spacers" name="rear_wheel_spacers" placeholder="Rear Wheel Spacer">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="wheel_title" class="form-label">Wheel Title</label>
                                <input type="text" class="form-control" id="wheel_title" name="wheel_title" placeholder="Wheel Title">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="front_wheel" class="form-label">Front Wheel</label>
                                <input type="text" class="form-control" id="front_wheel" name="front_wheel" placeholder="Front Wheel">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="rear_wheel" class="form-label">Rear Wheel</label>
                                <input type="text" class="form-control" id="rear_wheel" name="rear_wheel" placeholder="Rear Wheel">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="back_spacing_wheel" class="form-label">Back Spacing Wheel</label>
                                <input type="text" class="form-control" id="back_spacing_wheel" name="back_spacing_wheel" placeholder="Back Spacing Wheel">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="tire_title" class="form-label">Tire Title</label>
                                <input type="text" class="form-control" id="tire_title" name="tire_title" placeholder="Tire Title">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="front_tire" class="form-label">Front Tire</label>
                                <input type="text" class="form-control" id="front_tire" name="front_tire" placeholder="Front Tire">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="rear_tire" class="form-label">Rear Tire</label>
                                <input type="text" class="form-control" id="rear_tire" name="rear_tire" placeholder="Rear Tire">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="suspension_brand" class="form-label">Suspension Brand</label>
                                <select class="form-select" name="suspension_brand">
                                    <option value="">Select Suspension</option>
                                    <?php $__currentLoopData = $formattedTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($type['type'] === 'Suspension'): ?>
                                            <?php $__currentLoopData = $type['names']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($name); ?>"><?php echo e($name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="suspension" class="form-label">Suspension</label>
                                <select class="form-select" name="suspension">
                                    <option value="">Select Suspension</option>
                                    <?php $__currentLoopData = $formattedTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($type['type'] === 'Suspension'): ?>
                                            <?php $__currentLoopData = $type['names']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($name); ?>"><?php echo e($name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="wheel_diameter" class="form-label">Wheel Diameter</label>
                                <select class="form-select" name="wheel_diameter">
                                    <option value="">Select Wheel Diameter</option>
                                    <?php $__currentLoopData = $formattedTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($type['type'] === 'Wheel Diameter'): ?>
                                            <?php $__currentLoopData = $type['names']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($name); ?>"><?php echo e($name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="wheel_width" class="form-label">Wheel Width</label>
                                <select class="form-select" name="wheel_width" id="">
                                    <option value="">Select Wheel Width</option>
                                    <?php $__currentLoopData = $formattedTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($type['type'] === 'Wheel Width'): ?>
                                            <?php $__currentLoopData = $type['names']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($name); ?>"><?php echo e($name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="tire_height" class="form-label">Tire Height</label>
                                <select class="form-select" name="tire_height" id="">
                                    <option value="">Select Tire Height</option>
                                    <?php $__currentLoopData = $formattedTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($type['type'] === 'Tire Height'): ?>
                                            <?php $__currentLoopData = $type['names']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($name); ?>"><?php echo e($name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="tire_width" class="form-label">Tire Width</label>
                                <select class="form-select" name="tire_width" id="">
                                    <option value="">Select Tire Width</option>
                                    <?php $__currentLoopData = $formattedTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($type['type'] === 'Tire Width'): ?>
                                            <?php $__currentLoopData = $type['names']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($name); ?>"><?php echo e($name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="offset_wheel" class="form-label">Wheel Offset</label>
                                <select class="form-select" name="offset_wheel" id="">
                                    <option value="">Select Wheel Offset</option>
                                    <?php $__currentLoopData = $formattedTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($type['type'] === 'Wheel Offset'): ?>
                                            <?php $__currentLoopData = $type['names']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($name); ?>"><?php echo e($name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="type_of_stance" class="form-label">Type of Stance</label>
                                <select class="form-select" name="type_of_stance" id="">
                                    <option value="">Select Type of Stance</option>
                                    <?php $__currentLoopData = $formattedTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($type['type'] === 'Type of Stance'): ?>
                                            <?php $__currentLoopData = $type['names']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($name); ?>"><?php echo e($name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="wheel_brand" class="form-label">Wheel Brand</label>
                                <select class="form-select" name="wheel_brand" id="">
                                    <option value="">Select Wheel Brand</option>
                                    <?php $__currentLoopData = $formattedTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($type['type'] === 'Wheel Brand'): ?>
                                            <?php $__currentLoopData = $type['names']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($name); ?>"><?php echo e($name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="wheel_model" class="form-label">Wheel Model</label>
                                <input type="text" class="form-control" id="wheel_model" name="wheel_model" placeholder="Wheel Model">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="tire_brand" class="form-label">Tire Brand</label>
                                <select class="form-select" name="tire_brand" id="">
                                    <option value="">Select Tire Brand</option>
                                    <?php $__currentLoopData = $formattedTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($type['type'] === 'Tire Brand'): ?>
                                            <?php $__currentLoopData = $type['names']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($name); ?>"><?php echo e($name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="tire_model" class="form-label">Tire Model</label>
                                <input type="text" class="form-control" id="tire_model" name="tire_model" placeholder="Tire Model">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="image" class="form-label">Image1</label>
                                <input type="file" class="form-control" id="image1" name="image1">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="image" class="form-label">Image2</label>
                                <input type="file" class="form-control" id="image2" name="image2">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="image" class="form-label">Image3</label>
                                <input type="file" class="form-control" id="image3" name="image3">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="image" class="form-label">Image4</label>
                                <input type="file" class="form-control" id="image4" name="image4">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="image" class="form-label">Image5</label>
                                <input type="file" class="form-control" id="image5" name="image5">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="image" class="form-label">Image6</label>
                                <input type="file" class="form-control" id="Image6" name="Image6">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="image" class="form-label">Image7</label>
                                <input type="file" class="form-control" id="image7" name="image7">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="image" class="form-label">Image8</label>
                                <input type="file" class="form-control" id="image8" name="image8">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="additional_information" class="form-label">Additional information</label>
                                <textarea class="form-control" name="additional_information" id="additional_information" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                
                  <a class="btn btn-primary text-white" id="submitBtn">Submit</a>
              </form>
              
              </div>
            </div>
          </div>
  </div>
</div>


<div class="row mb-5">
  <?php $__currentLoopData = $gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <div class="col-md-4 col-lg-4 mb-3">
      <div class="card h-100">
          <img class="card-img-top" src="<?php echo e(asset('storage/'.$item->image1)); ?>" width="300px" height="250px" alt="Card image cap">
          <div class="card-body d-flex flex-column justify-content-center align-items-center">
              <div class="text-center">
                <div class="row">
                    <div class="col-md-6">
                        <p><b>Year: </b><?php echo e($item->year); ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><b>Make: </b><?php echo e($item->make); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p><b>Model: </b><?php echo e($item->model); ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><b>Drive: </b><?php echo e($item->drive); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p><b>Vehicle Details: </b><?php echo e($item->vehicle_details); ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><b>Rubbing: </b><?php echo e($item->rubbing); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p><b>Trimming: </b><?php echo e($item->trimming); ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><b>Spacers: </b><?php echo e($item->spacers); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p><b>Front Wheel Spacers: </b><?php echo e($item->front_wheel_spacers); ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><b>Rear Wheel Spacers: </b><?php echo e($item->rear_wheel_spacers); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p><b>Wheel Title: </b><?php echo e($item->wheel_title); ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><b>Front Wheel: </b><?php echo e($item->front_wheel); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p><b>Rear Wheel: </b><?php echo e($item->rear_wheel); ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><b>Offset Wheel: </b><?php echo e($item->offset_wheel); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p><b>Backspacing Wheel: </b><?php echo e($item->backspacing_wheel); ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><b>Tire Title: </b><?php echo e($item->tire_title); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p><b>Front Tire: </b><?php echo e($item->front_tire); ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><b>Rear Tire: </b><?php echo e($item->rear_tire); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p><b>Brand Suspension: </b><?php echo e($item->brand_suspension); ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><b>Suspension: </b><?php echo e($item->suspension); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p><b>Modification: </b><?php echo e($item->modification); ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><b>Wheel Diameter: </b><?php echo e($item->wheel_diameter); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p><b>Wheel Width: </b><?php echo e($item->wheel_width); ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><b>Tire Height: </b><?php echo e($item->tire_height); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p><b>Tire Width: </b><?php echo e($item->tire_width); ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><b>Wheel Offset: </b><?php echo e($item->wheel_offset); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p><b>Type of Stance: </b><?php echo e($item->type_of_stance); ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><b>Wheel Brand: </b><?php echo e($item->wheel_brand); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p><b>Wheel Model: </b><?php echo e($item->wheel_model); ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><b>Tire Brand: </b><?php echo e($item->tire_brand); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p><b>Tire Model: </b><?php echo e($item->tire_model); ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><b>Additional Information: </b><?php echo e($item->additional_information); ?></p>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-6">
                        <p><b>Created At: </b><?php echo e($item->created_at->format('d-M-Y')); ?></p>
                    </div>
                </div>
                
              </div>
              
              <form action="<?php echo e(route('gallery.destroy', ['gallery' => $item->id])); ?>" method="POST">
                  <?php echo csrf_field(); ?>
                  <?php echo method_field('DELETE'); ?>
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this image?')">Delete</button>
              </form>
          </div>
      </div>
  </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>


<script>
    $(document).ready(function() {
        $('#yearSelect').change(function() {
            var year = $(this).val();
            $.ajax({
                type: "GET",
                url: "<?php echo e(route('getMakes')); ?>",
                data: {
                    year: year
                },
                success: function(data) {
                    var makes = data;
                    var makeSelect = $('#makeSelect');
                    makeSelect.empty();
                    makeSelect.append($('<option>', {
                        value: '',
                        text: 'Select Make'
                    }));
                    $.each(makes, function(index, value) {
                        makeSelect.append($('<option>', {
                            value: value,
                            text: value
                        }));
                    });
                    // Enable the make dropdown
                    makeSelect.prop('disabled', false);
                }
            });
        });

        $('#makeSelect').change(function() {
            var make = $(this).val();
            $.ajax({
                type: "GET",
                url: "<?php echo e(route('getModels')); ?>",
                data: {
                    make: make
                },
                success: function(data) {
                    var models = data;
                    var modelSelect = $('#modelSelect');
                    modelSelect.empty();
                    modelSelect.append($('<option>', {
                        value: '',
                        text: 'Select Model'
                    }));
                    $.each(models, function(index, value) {
                        modelSelect.append($('<option>', {
                            value: value,
                            text: value
                        }));
                    });
                    // Enable the model dropdown
                    modelSelect.prop('disabled', false);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
    $("#submitBtn").click(function() {
        var isValid = true;
        
        // Year
        if ($("select[name='year']").val() === "") {
            $("select[name='year']").addClass("is-invalid");
            isValid = false;
        } else {
            $("select[name='year']").removeClass("is-invalid");
        }
        
        // Make
        if ($("select[name='make']").val() === "") {
            $("select[name='make']").addClass("is-invalid");
            isValid = false;
        } else {
            $("select[name='make']").removeClass("is-invalid");
        }
        
        // Model
        if ($("select[name='model']").val() === "") {
            $("select[name='model']").addClass("is-invalid");
            isValid = false;
        } else {
            $("select[name='model']").removeClass("is-invalid");
        }
        
        // Drive
        if ($("select[name='drive']").val() === "") {
            $("select[name='drive']").addClass("is-invalid");
            isValid = false;
        } else {
            $("select[name='drive']").removeClass("is-invalid");
        }
        
        // // Rubbing
        // if ($("select[name='rubbing']").val() === "") {
        //     $("select[name='rubbing']").addClass("is-invalid");
        //     isValid = false;
        // } else {
        //     $("select[name='rubbing']").removeClass("is-invalid");
        // }
        
        // // Modification
        // if ($("select[name='modification']").val() === "") {
        //     $("select[name='modification']").addClass("is-invalid");
        //     isValid = false;
        // } else {
        //     $("select[name='modification']").removeClass("is-invalid");
        // }
        
        // // Spacers
        // if ($("select[name='spacers']").val() === "") {
        //     $("select[name='spacers']").addClass("is-invalid");
        //     isValid = false;
        // } else {
        //     $("select[name='spacers']").removeClass("is-invalid");
        // }
        
        // // Front Wheel Spacers
        // if ($("input[name='front_wheel_spacers']").val() === "") {
        //     $("input[name='front_wheel_spacers']").addClass("is-invalid");
        //     isValid = false;
        // } else {
        //     $("input[name='front_wheel_spacers']").removeClass("is-invalid");
        // }
        
        // // Rear Wheel Spacers
        // if ($("input[name='rear_wheel_spacers']").val() === "") {
        //     $("input[name='rear_wheel_spacers']").addClass("is-invalid");
        //     isValid = false;
        // } else {
        //     $("input[name='rear_wheel_spacers']").removeClass("is-invalid");
        // }
        
        // // Wheel Title
        // if ($("input[name='wheel_title']").val() === "") {
        //     $("input[name='wheel_title']").addClass("is-invalid");
        //     isValid = false;
        // } else {
        //     $("input[name='wheel_title']").removeClass("is-invalid");
        // }
        
        // // Front Wheel
        // if ($("input[name='front_wheel']").val() === "") {
        //     $("input[name='front_wheel']").addClass("is-invalid");
        //     isValid = false;
        // } else {
        //     $("input[name='front_wheel']").removeClass("is-invalid");
        // }
        
        // // Rear Wheel
        // if ($("input[name='rear_wheel']").val() === "") {
        //     $("input[name='rear_wheel']").addClass("is-invalid");
        //     isValid = false;
        // } else {
        //     $("input[name='rear_wheel']").removeClass("is-invalid");
        // }
        
        // // Offset Wheel
        // if ($("input[name='offset_wheel']").val() === "") {
        //     $("input[name='offset_wheel']").addClass("is-invalid");
        //     isValid = false;
        // } else {
        //     $("input[name='offset_wheel']").removeClass("is-invalid");
        // }
        
        // // Backspacing Wheel
        // if ($("input[name='back_spacing_wheel']").val() === "") {
        //     $("input[name='back_spacing_wheel']").addClass("is-invalid");
        //     isValid = false;
        // } else {
        //     $("input[name='back_spacing_wheel']").removeClass("is-invalid");
        // }
        
        // // Tire Title
        // if ($("input[name='tire_title']").val() === "") {
        //     $("input[name='tire_title']").addClass("is-invalid");
        //     isValid = false;
        // } else {
        //     $("input[name='tire_title']").removeClass("is-invalid");
        // }
        
        // // Front Tire
        // if ($("input[name='front_tire']").val() === "") {
        //     $("input[name='front_tire']").addClass("is-invalid");
        //     isValid = false;
        // } else {
        //     $("input[name='front_tire']").removeClass("is-invalid");
        // }
        
        // // Rear Tire
        // if ($("input[name='rear_tire']").val() === "") {
        //     $("input[name='rear_tire']").addClass("is-invalid");
        //     isValid = false;
        // } else {
        //     $("input[name='rear_tire']").removeClass("is-invalid");
        // }
        
        // // Suspension Brand
        // if ($("select[name='suspension_brand']").val() === "") {
        //     $("select[name='suspension_brand']").addClass("is-invalid");
        //     isValid = false;
        // } else {
        //     $("select[name='suspension_brand']").removeClass("is-invalid");
        // }
        
        // // Suspension
        // if ($("select[name='suspension']").val() === "") {
        //     $("select[name='suspension']").addClass("is-invalid");
        //     isValid = false;
        // } else {
        //     $("select[name='suspension']").removeClass("is-invalid");
        // }

        // // Wheel Diameter
        // if ($("select[name='wheel_diameter']").val() === "") {
        //     $("select[name='wheel_diameter']").addClass("is-invalid");
        //     isValid = false;
        // } else {
        //     $("select[name='wheel_diameter']").removeClass("is-invalid");
        // }

        // // Wheel Width
        // if ($("select[name='wheel_width']").val() === "") {
        //     $("select[name='wheel_width']").addClass("is-invalid");
        //     isValid = false;
        // } else {
        //     $("select[name='wheel_width']").removeClass("is-invalid");
        // }

        // // Tire Height
        // if ($("select[name='tire_height']").val() === "") {
        //     $("select[name='tire_height']").addClass("is-invalid");
        //     isValid = false;
        // } else {
        //     $("select[name='tire_height']").removeClass("is-invalid");
        // }

        // // Tire Width
        // if ($("select[name='tire_width']").val() === "") {
        //     $("select[name='tire_width']").addClass("is-invalid");
        //     isValid = false;
        // } else {
        //     $("select[name='tire_width']").removeClass("is-invalid");
        // }

        // // Wheel Offset
        // if ($("select[name='wheel_offset']").val() === "") {
        //     $("select[name='wheel_offset']").addClass("is-invalid");
        //     isValid = false;
        // } else {
        //     $("select[name='wheel_offset']").removeClass("is-invalid");
        // }

        // // Type of Stance
        // if ($("select[name='type_of_stance']").val() === "") {
        //     $("select[name='type_of_stance']").addClass("is-invalid");
        //     isValid = false;
        // } else {
        //     $("select[name='type_of_stance']").removeClass("is-invalid");
        // }

        // // Wheel Brand
        // if ($("select[name='wheel_brand']").val() === "") {
        //     $("select[name='wheel_brand']").addClass("is-invalid");
        //     isValid = false;
        // } else {
        //     $("select[name='wheel_brand']").removeClass("is-invalid");
        // }

        // // Wheel Model
        // if ($("input[name='wheel_model']").val() === "") {
        //     $("input[name='wheel_model']").addClass("is-invalid");
        //     isValid = false;
        // } else {
        //     $("input[name='wheel_model']").removeClass("is-invalid");
        // }

        // // Tire Brand
        // if ($("select[name='tire_brand']").val() === "") {
        //     $("select[name='tire_brand']").addClass("is-invalid");
        //     isValid = false;
        // } else {
        //     $("select[name='tire_brand']").removeClass("is-invalid");
        // }

        // // Tire Model
        // if ($("input[name='tire_model']").val() === "") {
        //     $("input[name='tire_model']").addClass("is-invalid");
        //     isValid = false;
        // } else {
        //     $("input[name='tire_model']").removeClass("is-invalid");
        // }

        // // Additional Information
        // if ($("textarea[name='additional_information']").val() === "") {
        //     $("textarea[name='additional_information']").addClass("is-invalid");
        //     isValid = false;
        // } else {
        //     $("textarea[name='additional_information']").removeClass("is-invalid");
        // }

        // Image
        var imageInput = $("input[name=image1]");

        if (imageInput.prop('files').length === 0) {
            imageInput.addClass("is-invalid");
            isValid = false;
        } else {
            imageInput.removeClass("is-invalid");
        }


        if (isValid) {
            $("#galleryForm").submit();
        }
    });
});

</script>














<?php if(session('success')): ?>
    <script>
        toastr.success('<?php echo e(session('success')); ?>');
    </script>
<?php endif; ?>

<?php if(session('error')): ?>
    <script>
        toastr.error('<?php echo e(session('error')); ?>');
    </script>
<?php endif; ?>

<?php if($errors->any()): ?>
    <script>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            toastr.error('<?php echo e($error); ?>');
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </script>
<?php endif; ?>



<?php $__env->stopSection(); ?>


<?php echo $__env->make('user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\project\liftnasium\app\resources\views/user/gallery/index.blade.php ENDPATH**/ ?>