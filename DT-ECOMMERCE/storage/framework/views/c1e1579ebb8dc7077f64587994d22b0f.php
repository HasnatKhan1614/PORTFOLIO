<?php $__env->startSection('content'); ?>
 
    <section class="shop-banner align-items-center">
      <div class="overlay align-items-center"></div>
      <div class="container z-2 position-relative align-items-center">
        <div class="row justify-content-center mb-4"> <!-- Center the content horizontally -->
          <div class="col-lg-12 text-center"> <!-- Center the text within the column -->
            <h3>CAR PARTS THAT EXCEED YOUR EXPECTATIONS</h3>
            
          </div>
        </div>
        <form action="<?php echo e(route('search')); ?>" method="POST">
          <?php echo csrf_field(); ?>
          <div class="row justify-content-center mb-4">
              <div class="col-lg-3">
                  <div class="input-group mb-3">
                      <select class="form-select rounded-0" aria-label="Select Year" name="year" id="yearSelect">
                          <option selected>Year</option>
                          <?php $__currentLoopData = $uniqueYears; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($year); ?>"><?php echo e($year); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                  </div>
              </div>
              <div class="col-lg-3">
                  <div class="input-group mb-3">
                      <select class="form-select rounded-0" aria-label="Select Make" name="make" id="makeSelect">
                          <option selected>Make</option>
                      </select>
                  </div>
              </div>
              <div class="col-lg-3">
                  <div class="input-group mb-3">
                      <select class="form-select rounded-0" aria-label="Select Model" name="model" id="modelSelect">
                          <option selected>Model</option>
                      </select>
                  </div>
              </div>
          </div>
          <div class="row justify-content-center">
              <div class="col-lg-12 text-center">
                  <button type="submit" class="my-btn">Submit</button>
              </div>
          </div>
      </form>
      </div>
    </section>

    <section class="comapnies">
      <div class="container">
          <div class="row">
              <div class="col-12 mb-4 text-center">
                  <h4 class="font-monsteret heading-color">Parts & Accessories</h4>
              </div>
              <div class="col-12">
                  <form id="categoryForm" action="<?php echo e(route('search')); ?>" method="POST">
                      <?php echo csrf_field(); ?>
                      <div id="ymm-landing-page" class="home-store-section">
                          <!-- view -->
                          <section class="product-offering-section">
                              <div class="container">
                                  <div id="breadcrumb-container"></div>
                                  <ul id="" class="product-offerings flex-2-col">
                                      <?php $__currentLoopData = $uniqueProductByCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <li>
                                              <a onclick="submitForm('<?php echo e($item->category); ?>')">
                                                  <h2>Wheel &amp; <?php echo e($item->category); ?></h2>
                                                  <img src="<?php echo e($item->image_1); ?>"
                                                      
                                                      alt="Shop Wheel &amp; Tire Packages for your Truck"
                                                      title="Shop Wheel &amp; Tire Packages for your Truck" />
                                              </a>
                                          </li>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </ul>
                              </div>
                          </section>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </section>
  

    <section class="new-arrival">
      <div class="container">
      

        <div class="row mb-4">
          <div class="col-12 text-black">
            <h5 class="font-monsteret heading-color">NEW ARRIVAL PARTS</h5>
          </div>
        </div>
        
        <form action="<?php echo e(url('/shop')); ?>" method="get">
          <div class="row mb-3">
            <div class="col-auto">
              <label for="itemsPerPage" class="col-form-label">Items Per Page:</label>
            </div>
            <div class="col-auto">
              <select class="form-select" id="itemsPerPage" name="items" onchange="this.form.submit()">
                <option value="6" <?php echo e($recordsPerPage * 2 == 6 ? 'selected' : ''); ?>>6</option>
                <option value="12" <?php echo e($recordsPerPage * 2 == 12 ? 'selected' : ''); ?>>12</option>
                <option value="24" <?php echo e($recordsPerPage * 2 == 24 ? 'selected' : ''); ?>>24</option>
                <option value="48" <?php echo e($recordsPerPage * 2 == 48 ? 'selected' : ''); ?>>48</option>
              </select>
            </div>
          </div>
        </form>

        <div class="row">

          <div class="col-md-3">
              <form action="<?php echo e(route('search')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php
                    $categories = DB::table('general')
                        ->distinct()
                        ->pluck('category');
                ?>
                <div class="mb-3">
                  <h6>Categories</h6>
                  <div class="list-group" id="categoryList">
                      <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <label class="list-group-item<?php echo e($index >= 12 ? ' d-none' : ''); ?>">
                              <input class="form-check-input me-1" type="checkbox" name="categories[]" value="<?php echo e($category); ?>" <?php echo e(in_array($category, $request->categories ?? []) ? 'checked' : ''); ?>>
                              <?php echo e($category); ?>

                          </label>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                  <div class="d-flex justify-content-end">
                      <?php if(count($categories) > 10): ?>
                          <div id="showMoreBtn" class="text-danger">Show More</div>
                          <div id="showLessBtn" class="text-danger d-none">Show Less</div>
                      <?php endif; ?>
                  </div>
                </div>

                <div class="mb-3">
                    <h6>Price</h6>
                    <div class="row">
                        <div class="col">
                            <label for="min" class="form-label">Min</label>
                            <input value="<?php echo e($request->min_price); ?>" type="number" class="form-control" id="min" name="min_price" placeholder="Min">
                        </div>
                        <div class="col">
                            <label for="max" class="form-label">Max</label>
                            <input value="<?php echo e($request->max_price); ?>" type="number" class="form-control" id="max" name="max_price" placeholder="Max">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="my-btn">Search</button>
                        </div>
                    </div>
                </div>
              </form>
            </div>
        
          <div class="col-9">
            <div class="row justify-content-center mt-5">
                <div class="col-md-6 text-center">
                    <?php if($processedCollection->isEmpty()): ?>
                        <p>No Items or Packages Found</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
              <?php $__currentLoopData = $processedCollection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="col-lg-3 mb-5 col-md-6">
                    <div class="product-box border">
                        <div class="image">
                            <!-- Check if images array exists and has elements -->
                            <?php if(isset($item['images'])): ?>
                                <img src="<?php echo e($item['images']); ?>" alt="<?php echo e($item['title']); ?>" class="img-fluid">
                            <?php endif; ?>
                            
                            <div class="hidden-items">
                                <!-- First anchor for product detail modal -->
                                <a href="#" 
                                  data-bs-toggle="modal" 
                                  data-bs-target="#ProductDetail-<?php echo e($key); ?>" 
                                  data-bs-tooltip="tooltip" 
                                  data-bs-placement="top" 
                                  data-bs-title="Quick view" 
                                  data-bs-custom-class="custom-tooltip">
                                    <i class="fa-solid fa-up-right-and-down-left-from-center"></i>
                                </a>
    
                                <!-- Second anchor for adding to wishlist -->
                                <a href="#" 
                                  data-bs-toggle="tooltip" 
                                  data-bs-placement="top" 
                                  data-bs-title="Add to Wishlist" 
                                  data-bs-custom-class="custom-tooltip">
                                    <i class="fa-regular fa-heart"></i>
                                </a>
    
                                <!-- Third anchor for add to cart modal -->
                                <a href="#" 
                                  data-bs-toggle="modal" 
                                  data-bs-target="#shoppingCartModal"
                                  data-bs-placement="top" 
                                  data-bs-title="Add to Cart" 
                                  data-bs-custom-class="custom-tooltip"
                                  class="add-to-cart"
                                  data-id="<?php echo e($item['sku']); ?>" 
                                  data-name="<?php echo e($item['title']); ?>" 
                                  data-price="<?php echo e($item['prices']); ?>" 
                                  data-image="<?php echo e($item['images']); ?>" 
                                  data-vendor="Vendor Name">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </a>
                            </div>
                        </div>
                        <div class="text">
    
                            <?php if($item['vendorName'] == 'wheelpros'): ?>
                            <h6>
                              <a href="<?php echo e(url('/wp-product-detail/'.$item['sku'])); ?>"><?php echo e($item['title']); ?></a>
                            </h6>
                            <?php endif; ?>
    
                            <?php if($item['vendorName'] == 'roughcountry'): ?>
                            <h6>
                              <a href="<?php echo e(url('/rc-product-detail/'.$item['sku'])); ?>"><?php echo e($item['title']); ?></a>
                            </h6>
                            <?php endif; ?>
    
                            <!-- Assuming MSRP is present in the prices array -->
                            <?php if(isset($item['prices'])): ?>
                            <div class="price d-flex gap-2 justify-content-center align-items-center">
                                <!-- Real price is set to be 10% higher than the regular price -->
                                
                                <!-- Actual regular price -->
                                <p class="regular-price">$<?php echo e($item['prices']); ?></p>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- Product Modal -->
                <div class="modal fade custom-modal-width" id="ProductDetail-<?php echo e($key); ?>" tabindex="-1" role="dialog" aria-labelledby="ProductDetailTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header border-0">
                        <p class="modal-title" id="shoppingCartModalLabel"></p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <!-- Image Column -->
                          <div class="col-md-8">
                            <?php if(isset($item['images'])): ?>
                                <img src="<?php echo e($item['images']); ?>" alt="<?php echo e($item['title']); ?>" class="img-fluid">
                            <?php endif; ?>
                          </div>
                          <!-- Details Column -->
                          <div class="closest-input-quantity col-md-4 d-flex flex-column justify-content-center border-bottom">
    
                            <span class="card-title my-3" style="font-size: 28px;"><?php echo e($item['title']); ?></span>
                            <p class="card-text my-3">
                              
                              <span class="price current-price">$<?php echo e($item['prices']); ?></span>
                            </p>
                            <div class="count d-flex align-items-center gap-3 p-3">
                              <button type="button" class="decrement">-</button>
                              <p class="number quantity-input">1</p>
                              <button type="button" class="increment">+</button>
                            </div>
                            
                            <button
                            data-bs-toggle="modal"
                            data-bs-target="#shoppingCartModal"
                            data-bs-placement="top"
                            data-bs-title="Add to Cart"
                            data-bs-custom-class="custom-tooltip"
                            data-id="<?php echo e($item['sku']); ?>"
                            data-name="<?php echo e($item['title']); ?>"
                            data-price="<?php echo e($item['prices']); ?>" 
                            data-image="<?php echo e($item['images']); ?>" 
                            data-vendor="Vendor Name"
                            class="add-to-cart my-btn"
                            >Add to Cart</button>
                            <div class="d-flex align-items-center my-2">
                                <i class="fa fa-heart"></i>
                            </div>
                          <div class="d-flex align-items-center mt-2">
                              <span>Categories: <?php echo e($item['skuType']); ?></span>
                          </div>
                          </div>
                        </div>
                      </div>
                      
    
                      
                    </div>
                  </div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="align-items-center">
      <div class="container">
          <nav aria-label="Page navigation example">
              <ul class="pagination justify-content-center">
  
                  <!-- Link to the first page -->
                  <li class="page-item <?= ($currentPage == 1) ? 'disabled' : '' ?>">
                      <a class="page-link" href="<?php echo e(route('search', array_merge(request()->query(), ['page' => 1]))); ?>">First</a>
                  </li>
  
                  <!-- Link to the previous page -->
                  <li class="page-item <?= ($currentPage <= 1) ? 'disabled' : '' ?>">
                      <a class="page-link" href="<?php echo e(route('search', array_merge(request()->query(), ['page' => max($currentPage - 1, 1)]))); ?>">Previous</a>
                  </li>
  
                  <!-- Dynamic page links -->
                  <?php for($i = max(1, $currentPage - 10); $i <= min($totalPages, $currentPage + 10); $i++): ?>
                      <li class="page-item <?= ($i == $currentPage) ? 'active bg-danger' : '' ?>">
                          <a class="page-link" href="<?php echo e(route('search', array_merge(request()->query(), ['page' => $i]))); ?>"><?php echo e($i); ?></a>
                      </li>
                  <?php endfor; ?>
  
                  <!-- Link to the next page -->
                  <li class="page-item <?= ($currentPage >= $totalPages) ? 'disabled' : '' ?>">
                      <a class="page-link" href="<?php echo e(route('search', array_merge(request()->query(), ['page' => min($currentPage + 1, $totalPages)]))); ?>">Next</a>
                  </li>
  
                  <!-- Link to the last page -->
                  <li class="page-item <?= ($currentPage == $totalPages) ? 'disabled' : '' ?>">
                      <a class="page-link" href="<?php echo e(route('search', array_merge(request()->query(), ['page' => $totalPages]))); ?>">Last</a>
                  </li>
              </ul>
          </nav>
      </div>
  </section>
  
  
  
  
  
    
  
  

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
  $(document).ready(function () {
      $('#yearSelect').change(function () {
          var year = $(this).val();
          $.ajax({
              type: "GET",
              url: "<?php echo e(route('getMakes')); ?>",
              data: { year: year },
              success: function (data) {
                  var makes = data;
                  var makeSelect = $('#makeSelect');
                  makeSelect.empty();
                  makeSelect.append($('<option>', {
                      value: '',
                      text: 'Select Make'
                  }));
                  $.each(makes, function (index, value) {
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

      $('#makeSelect').change(function () {
          var make = $(this).val();
          $.ajax({
              type: "GET",
              url: "<?php echo e(route('getModels')); ?>",
              data: { make: make },
              success: function (data) {
                  var models = data;
                  var modelSelect = $('#modelSelect');
                  modelSelect.empty();
                  modelSelect.append($('<option>', {
                      value: '',
                      text: 'Select Model'
                  }));
                  $.each(models, function (index, value) {
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



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Hasnat Khan\Desktop\Diligenttek\liftnasium\resources\views/filter-result.blade.php ENDPATH**/ ?>