


<link href="https://images.enthusiastenterprises.us/css/revamp/min/global.min.2.26.13.css" rel="stylesheet" />
<link href="https://images.enthusiastenterprises.us/css/revamp/min/ymm-landing.min.2.0.8.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<?php $__env->startSection('content'); ?>
    <div id='co-banneroffset'>
        <div>
            <div id="gallery-slider-wrap-images" class="gallery-detail-wrapper-images">
              <ul class="slider slider-nav-images">
                <?php if(isset($data->image1)): ?>
                <div class="gal-bg">
                    <img class="img-fluid" data-srcset="<?php echo e(asset('storage/'.$data->image1)); ?>" src="<?php echo e(asset('storage/'.$data->image1)); ?>" />
                </div>
                <?php endif; ?>
                <?php if(isset($data->image2)): ?>
                    <div class="gal-bg">
                        <img class="img-fluid" data-srcset="<?php echo e(asset('storage/'.$data->image2)); ?>" src="<?php echo e(asset('storage/'.$data->image2)); ?>" />
                    </div>
                <?php endif; ?>
                <?php if(isset($data->image3)): ?>
                    <div class="gal-bg">
                        <img class="img-fluid" data-srcset="<?php echo e(asset('storage/'.$data->image3)); ?>" src="<?php echo e(asset('storage/'.$data->image3)); ?>" />
                    </div>
                <?php endif; ?>
                <?php if(isset($data->image4)): ?>
                    <div class="gal-bg">
                        <img class="img-fluid" data-srcset="<?php echo e(asset('storage/'.$data->image4)); ?>" src="<?php echo e(asset('storage/'.$data->image4)); ?>" />
                    </div>
                <?php endif; ?>
                <?php if(isset($data->image5)): ?>
                    <div class="gal-bg">
                        <img class="img-fluid" data-srcset="<?php echo e(asset('storage/'.$data->image5)); ?>" src="<?php echo e(asset('storage/'.$data->image5)); ?>" />
                    </div>
                <?php endif; ?>
                <?php if(isset($data->image6)): ?>
                    <div class="gal-bg">
                        <img class="img-fluid" data-srcset="<?php echo e(asset('storage/'.$data->image6)); ?>" src="<?php echo e(asset('storage/'.$data->image6)); ?>" />
                    </div>
                <?php endif; ?>
                <?php if(isset($data->image7)): ?>
                    <div class="gal-bg">
                        <img class="img-fluid" data-srcset="<?php echo e(asset('storage/'.$data->image7)); ?>" src="<?php echo e(asset('storage/'.$data->image7)); ?>" />
                    </div>
                <?php endif; ?>
                <?php if(isset($data->image8)): ?>
                    <div class="gal-bg">
                        <img class="img-fluid" data-srcset="<?php echo e(asset('storage/'.$data->image8)); ?>" src="<?php echo e(asset('storage/'.$data->image8)); ?>" />
                    </div>
                <?php endif; ?>
              </ul>
              <div class="gal-slider-images">
                <div class="slider slider-for-images">
                  <div class="gal-main">
                    <img class="img-fluid" data-srcset="<?php echo e(asset('storage/'.$data->image1)); ?>" src="<?php echo e(asset('storage/'.$data->image1)); ?>" />
                  </div>
                  <div class="gal-main">
                    <img class="img-fluid" data-srcset="<?php echo e(asset('storage/'.$data->image2)); ?>" src="<?php echo e(asset('storage/'.$data->image2)); ?>" />
                  </div>
                  <div class="gal-main">
                    <img class="img-fluid" data-srcset="<?php echo e(asset('storage/'.$data->image3)); ?>" src="<?php echo e(asset('storage/'.$data->image3)); ?>" />
                  </div>
                  <div class="gal-main">
                    <img class="img-fluid" data-srcset="<?php echo e(asset('storage/'.$data->image4)); ?>" src="<?php echo e(asset('storage/'.$data->image4)); ?>" />
                  </div>
                  <div class="gal-main">
                    <img class="img-fluid" data-srcset="<?php echo e(asset('storage/'.$data->image5)); ?>" src="<?php echo e(asset('storage/'.$data->image5)); ?>" />
                  </div>
                  <div class="gal-main">
                    <img class="img-fluid" data-srcset="<?php echo e(asset('storage/'.$data->image6)); ?>" src="<?php echo e(asset('storage/'.$data->image6)); ?>" />
                  </div>
                  <div class="gal-main">
                    <img class="img-fluid" data-srcset="<?php echo e(asset('storage/'.$data->image7)); ?>" src="<?php echo e(asset('storage/'.$data->image7)); ?>" />
                  </div>
                  <div class="gal-main">
                    <img class="img-fluid" data-srcset="<?php echo e(asset('storage/'.$data->image8)); ?>" src="<?php echo e(asset('storage/'.$data->image8)); ?>" />
                  </div>
                </div>
                
              </div>
              <div id="gallery-modal" class="modal">
                <!-- soical media icons -->
                <div class="share-btn-container">
                  <div class="close-btn-container">
                    <div aria-label="Close" class="close-btn">&#xd7;</div>
                  </div>
                  <div class="social-media-wrapper">
                    <a href="#" class="facebook-btn" target="_blank">
                      <svg class="svg-facebook-f" width="32px" viewBox="0 0 512 512">
                        <g>
                          <path fill="#426782" class="st0" d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z" />
                        </g>
                      </svg>
                    </a>
                    <a href="#" class="twitter-btn" target="_blank">
                      <svg class="svg-twitter" width="32px" viewBox="0 0 512 512">
                        <g>
                          <path class="st0" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z" />
                        </g>
                      </svg>
                    </a>
                    <a href="#" class="pinterest-btn" target="_blank">
                      <svg class="svg-pinterest" width="32px" viewBox="0 0 512 512">
                        <path fill="#e60023" d="M496 256c0 137-111 248-248 248-25.6 0-50.2-3.9-73.4-11.1 10.1-16.5 25.2-43.5 30.8-65 3-11.6 15.4-59 15.4-59 8.1 15.4 31.7 28.5 56.8 28.5 74.8 0 128.7-68.8 128.7-154.3 0-81.9-66.9-143.2-152.9-143.2-107 0-163.9 71.8-163.9 150.1 0 36.4 19.4 81.7 50.3 96.1 4.7 2.2 7.2 1.2 8.3-3.3.8-3.4 5-20.3 6.9-28.1.6-2.5.3-4.7-1.7-7.1-10.1-12.5-18.3-35.3-18.3-56.6 0-54.7 41.4-107.6 112-107.6 60.9 0 103.6 41.5 103.6 100.9 0 67.1-33.9 113.6-78 113.6-24.3 0-42.6-20.1-36.7-44.8 7-29.5 20.5-61.3 20.5-82.6 0-19-10.2-34.9-31.4-34.9-24.9 0-44.9 25.7-44.9 60.2 0 22 7.4 36.8 7.4 36.8s-24.5 103.8-29 123.2c-5 21.4-3 51.6-.9 71.2C65.4 450.9 0 361.1 0 256 0 119 111 8 248 8s248 111 248 248z" />
                      </svg>
                    </a>
                  </div>
                </div>
              </div>
            </div>
        </div>

        <div class='gallery-page-container'>
            
            <div class="title-container">
                <div class="owner-photographer">

                </div>
                <h1><?php echo e($data->year); ?> <?php echo e($data->make); ?> <?php echo e($data->model); ?><br><span><span></h1>
            </div>
            

            <div class='about-this-build'>
                <h2>About this Build</h2>
                <div class='about-this-build-info'>
                    <div class='from-the-owner'>
                        <a id='from-the-owner-info'>
                            <h4 class='gallery-build-section-detials'>Vehicle Details:</h4>
                            <?php echo e($data->vehicle_details); ?>

                        </a>
                    </div>
                    <div class='rubbing-trimming-spacers'>
                        <h4>Rubbing:</br><span><?php echo e($data->rubbing); ?></span></h4>
                        </br>
                        <h4>Trimming:</br><span><?php echo e($data->modification); ?></span></h4>
                        </br>
                        <h4>Front Wheel Spacers:</br><span><?php echo e($data->front_wheel_spacers); ?></span></h4>
                        </br>
                        
                        
                        <h4>Stance:</br><span><?php echo e($data->type_of_stance); ?></span></h4>
                        </br>
                    </div>
                </div>
            </div>
            <table class='product-container-table'>
                <tr>
                    <th class='th-col2' id='accordion-wheel' colspan='2'>
                        <h2 >Wheel Info</h2>
                    </th>
                </tr>
                
                <tr class='accordion-content-wheel'>
                    <td class='first-columm'>
                        <h4>Front: <a href='#' class='url-size'><?php echo e($data->front_wheel); ?></a></h4><br />
                        <h4>Offset:
                            <p><?php echo e($data->offset_wheel); ?></p>
                        </h4><br />
                        <h4>Backspacing:
                            <p><?php echo e($data->backspacing_wheel); ?></p>
                        </h4><br />
                    </td>
                    <td class='second-columm'>
                        <h4>Rear: <a href='#' class='url-size'><?php echo e($data->rear_wheel); ?></a></h4><br />
                        <h4>Offset:
                            <p><?php echo e($data->offset_wheel); ?></p><br />
                            <h4>Backspacing:
                                <p><?php echo e($data->backspacing_wheel); ?></p>
                            </h4><br />
                    </td>
                </tr>
                <tr>
                    <th class='th-col2' id='accordion-tire' colspan='2'>
                        <h2>Tire Info</h2>
                    </th>
                </tr>
                <tr class='accordion-content-tire h3-product-name'>
                    <td class='td-col2' colspan='2'>
                        <h3>
                            <p style='font-size: 18px;'></p>
                        </h3>
                    </td>
                </tr>
                <tr class='accordion-content-tire'>
                    <td class='first-columm-f'>
                        <h4>Front:<br /><a href='#' class='url-size'><?php echo e($data->front_tire); ?><br /></a></h4>
                    </td>
                    <td>
                        <div class='second-columm-r'>
                            <h4>Rear:<br /><a href='#' class='url-size'><?php echo e($data->rear_tire); ?><br /></a>
                            </h4>
                        </div>
                    </td>
                </tr>
                <th colspan='2' id='accordion-suspension' class='th-col2'>
                    <h2>Suspension Info</h2>
                </th>
                <tr class='accordion-content-suspension'>
                    <td class='first-columm'>
                        <h4>Brand:<a href='#' class='url-size'><?php echo e($data->brand_suspension); ?></a></h4>
                    </td>
                    <td class='second-columm'>
                        <h4>Suspension:<a href='#' class='url-size'><?php echo e($data->suspension); ?></a></h4>
                    </td>
            </table>
            
            <div class="additional-information-seo">
                <h2> Additional Information </h2>
                <?php echo e($data->additional_information); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src='https://images.customwheeloffset.com/js/slick.min.1.0.js'></script>
    <script>
        $(window).on('load', function() {
            $('.slider-for-images').slick({
                lazyLoad: 'progressive',
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                fade: true,
                asNavFor: '.slider-nav-images'
            });
            $('.slider-nav-images').slick({
                lazyLoad: 'progressive',
                slidesToShow: 1,
                slidesToScroll: 1,
                asNavFor: '.slider-for-images',
                dots: true,
                arrows: false,
                focusOnSelect: true,
                responsive: [{
                        breakpoint: 769,
                        settings: {
                            arrows: false,
                            dots: true,
                            centerPadding: '40px',
                            slidesToScroll: 1,
                            slidesToShow: 1
                        }
                    },
                    {
                        breakpoint: 414,
                        settings: {
                            arrows: false,
                            dots: true,
                            centerPadding: '40px',
                            slidesToScroll: 1,
                            slidesToShow: 1
                        }
                    }
                ]
            });
            $('.sim-vehicle-slider').slick({
                arrows: true,
                centerMode: true,
                draggable: true,
                infinite: true,
                variableWidth: true,
                slidesToShow: 2,
                slidesToScroll: 1,
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\project\liftnasium\app\resources\views/gallery-detail.blade.php ENDPATH**/ ?>