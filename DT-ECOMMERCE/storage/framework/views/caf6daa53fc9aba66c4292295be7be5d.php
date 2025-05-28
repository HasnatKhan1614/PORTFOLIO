<?php $__env->startSection('content'); ?>



    <section class="main-banner">
      <div class="overlay"></div>
      <div class="container z-2 position-relative">
        <div class="row justify-content-center mb-4">
          <!-- Center the content horizontally -->
          <div class="col-lg-12 text-center">
              <!-- Center the text within the column -->
              <h3>Elevate Your Ride with Quality You Can Trust!</h3>
          </div>
          <div class="page">
              <!-- tabs -->
              <div class="pcss3t pcss3t-effect-scale pcss3t-theme-1">
                  <input type="radio" name="pcss3t" checked id="tab1"class="tab-content-first">
                  <label for="tab1"></i>SHOP BY VEHICLE</label>
                  <input type="radio" name="pcss3t" id="tab2" class="tab-content-2">
                  <label for="tab2"></i>WHEELS BY SIZE & BRAND</label>
                  <input type="radio" name="pcss3t" id="tab3" class="tab-content-3">
                  <label for="tab3"></i>SEARCH TIRES</label>
                  <input type="radio" name="pcss3t" id="tab5" class="tab-content-last">
                  <label for="tab5"></i>SEARCH GALLERY</label>
                  <ul>

                      <li class="tab-content tab-content-first typography">
                          <form action="<?php echo e(route('search')); ?>" method="POST" style="width: 100%;">
                              <?php echo csrf_field(); ?>
                              <input type="hidden" name="type" value="vehicle" id="">
                              <div class="row" style="justify-content: center;width: 100%;">
                                  <div class="col-lg-4">
                                      <div class="input-group mb-3">
                                          <select class="form-select rounded-0" aria-label="Select Year" name="year" id="yearSelect">
                                              <option selected="">Year</option>
                                              <?php
                                              $currentYear = date('Y');
                                              $startYear = 1948;
                                              
                                              for ($year = $currentYear; $year >= $startYear; $year--) {
                                                  echo "<option value=\"$year\">$year</option>";
                                              }
                                              ?>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-lg-4">
                                      <div class="input-group mb-3">
                                          <select class="form-select rounded-0" aria-label="Select Make"
                                              name="make" id="makeSelect">
                                              <option selected>Make</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-lg-4">
                                      <div class="input-group mb-3">
                                          <select class="form-select rounded-0" aria-label="Select Model"
                                              name="model" id="modelSelect">
                                              <option selected>Model</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="row justify-content-center">
                                      <div class="col-lg-12 text-center">
                                          <button type="submit" class="my-btn">Submit</button>
                                      </div>
                                  </div>
                              </div>
                          </form>
                      </li>



                      <li class="tab-content tab-content-2 typography">
                          <form action="<?php echo e(route('search')); ?>" method="POST" style="width: 100%;">
                              <?php echo csrf_field(); ?>
                              <input type="hidden" name="type" value="wheel" id="">
                              <div class="row" style="justify-content: center;width: 100%;">
                                  <div class="col-lg-4" >
                                      <div class="input-group mb-3">
                                          <select class="form-select rounded-0" aria-label="Select Wheel Diameter"
                                              name="wheelDiameter" id="wheelDiameterSelect">
                                              <option selected="">Wheel Diameter</option>
                                              <option class="ymm-li" value="14">14"</option>
                                              <option class="ymm-li" value="15">15"</option>
                                              <option class="ymm-li" value="16">16"</option>
                                              <option class="ymm-li" value="17">17"</option>
                                              <option class="ymm-li" value="18">18"</option>
                                              <option class="ymm-li" value="19">19"</option>
                                              <option class="ymm-li" value="20">20"</option>
                                              <option class="ymm-li" value="21">21"</option>
                                              <option class="ymm-li" value="22">22"</option>
                                              <option class="ymm-li" value="24">24"</option>
                                              <option class="ymm-li" value="26">26"</option>
                                              <option class="ymm-li" value="28">28"</option>
                                              <option class="ymm-li" value="30">30"</option>
                                              <option class="ymm-li" value="32">32"</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-lg-4">
                                      <div class="input-group mb-3">
                                          <select class="form-select rounded-0" aria-label="Select Wheel Width"
                                              name="wheelWidth" id="wheelWidthSelect">
                                              <option selected="">Wheel Width</option>
                                              <option class="ymm-li" value="5">5"</option>
                                              <option class="ymm-li" value="5.5">5.5"</option>
                                              <option class="ymm-li" value="6">6"</option>
                                              <option class="ymm-li" value="6.5">6.5"</option>
                                              <option class="ymm-li" value="6.75">6.75"</option>
                                              <option class="ymm-li" value="7">7"</option>
                                              <option class="ymm-li" value="7.25">7.25"</option>
                                              <option class="ymm-li" value="7.5">7.5"</option>
                                              <option class="ymm-li" value="8">8"</option>
                                              <option class="ymm-li" value="8.25">8.25"</option>
                                              <option class="ymm-li" value="8.5">8.5"</option>
                                              <option class="ymm-li" value="8.75">8.75"</option>
                                              <option class="ymm-li" value="9">9"</option>
                                              <option class="ymm-li" value="9.25">9.25"</option>
                                              <option class="ymm-li" value="9.5">9.5"</option>
                                              <option class="ymm-li" value="9.75">9.75"</option>
                                              <option class="ymm-li" value="10">10"</option>
                                              <option class="ymm-li" value="10.25">10.25"</option>
                                              <option class="ymm-li" value="10.5">10.5"</option>
                                              <option class="ymm-li" value="10.75">10.75"</option>
                                              <option class="ymm-li" value="11">11"</option>
                                              <option class="ymm-li" value="11.5">11.5"</option>
                                              <option class="ymm-li" value="12">12"</option>
                                              <option class="ymm-li" value="12.5">12.5"</option>
                                              <option class="ymm-li" value="13">13"</option>
                                              <option class="ymm-li" value="14">14"</option>
                                              <option class="ymm-li" value="15">15"</option>
                                              <option class="ymm-li" value="16">16"</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-lg-4">
                                      <div class="input-group mb-3">
                                          <select class="form-select rounded-0" aria-label="Select Bolt Pattern"
                                              name="boltPattern" id="boltPatternSelect">
                                              <option selected="">Bolt Pattern</option>
                                              <option class="ymm-li" value="3x4.41,3x112">3x112mm (3x4.41")</option>
                                              <option class="ymm-li" value="4x101.6,4x4">4x4" (4x101.6mm)</option>
                                              <option class="ymm-li" value="4x4.25,4x108">4x4.25" (4x108mm)</option>
                                              <option class="ymm-li" value="4x4.5,4x114.3">4x4.5" (4x114.3mm)
                                              </option>
                                              <option class="ymm-li" value="4x98,4x3.86">4x98mm (4x3.86")</option>
                                              <option class="ymm-li" value="4x3.94,4x100">4x100mm (4x3.94")</option>
                                              <option class="ymm-li" value="4x4.33,4x110">4x110mm (4x4.33")</option>
                                              <option class="ymm-li" value="4x4.92,4x125">4x115mm (4x4.92")</option>
                                              <option class="ymm-li" value="4x5.35,4x136">4x136mm (4x5.35")</option>
                                              <option class="ymm-li" value="4x6.14,4x156">4x156mm (4x6.14")</option>
                                              <option class="ymm-li" value="5x101.6,5x4">5x4" (5x101.6mm)</option>
                                              <option class="ymm-li" value="5x4.25,5x108">5x4.25" (5x108mm)</option>
                                              <option class="ymm-li" value="5x4.5,5x114.3">5x4.5" (5x114.3mm)
                                              </option>
                                              <option class="ymm-li" value="5x5,5x127">5x5" (5x127mm)</option>
                                              <option class="ymm-li" value="5x5.5,5x139.7">5x5.5" (5x139.7mm)
                                              </option>
                                              <option class="ymm-li" value="5x6.3,5x160">5x160mm (5x6.3")</option>
                                              <option class="ymm-li" value="5x6.5,5x165.1">5x6.5" (5x165.1mm)
                                              </option>
                                              <option class="ymm-li" value="5x3.94,5x100">5x100mm (5x3.94")</option>
                                              <option class="ymm-li" value="5x4.13,5x105">5x105mm (5x4.13")</option>
                                              <option class="ymm-li" value="5x4.33,5x110">5x110mm (5x4.33")</option>
                                              <option class="ymm-li" value="5x4.41,5x112">5x112mm (5x4.41")</option>
                                              <option class="ymm-li" value="5x4.52,5x115">5x115mm (5x4.52")</option>
                                              <option class="ymm-li" value="5x4.75,5x120.65">5x4.75" (5x120.65mm)
                                              </option>
                                              <option class="ymm-li" value="5x4.72,5x120">5x120mm (5x4.72")</option>
                                              <option class="ymm-li" value="5x5.12,5x130">5x130mm (5x5.12")</option>
                                              <option class="ymm-li" value="5x5.3,5x135">5x135mm (5x5.3")</option>
                                              <option class="ymm-li" value="5x5.91,5x150">5x150mm (5x5.91")</option>
                                              <option class="ymm-li" value="5x6.1,5x155">5x155mm (5x6.1")</option>
                                              <option class="ymm-li" value="5x8.07,5x205">5x205mm (5x8.07")</option>
                                              <option class="ymm-li" value="5x98,5x3.86">5x98mm (5x3.86")</option>
                                              <option class="ymm-li" value="6x4.5,6x114.3">6x4.5" (6x114.3mm)
                                              </option>
                                              <option class="ymm-li" value="6x5,6x127">6x5" (6x127mm)</option>
                                              <option class="ymm-li" value="6x5.5,6x139.7">6x5.5" (6x139.7mm)
                                              </option>
                                              <option class="ymm-li" value="6x4.52,6x115">6x115mm (6x4.52")</option>
                                              <option class="ymm-li" value="6x4.72,6x120">6x120mm (6x4.72")</option>
                                              <option class="ymm-li" value="6x5.12,6x130">6x130mm (6x5.12")</option>
                                              <option class="ymm-li" value="6x5.2,6x132">6x132mm (6x5.2")</option>
                                              <option class="ymm-li" value="6x5.3,6x135">6x135mm (6x5.3")</option>
                                              <option class="ymm-li" value="7x150,7x5.91">7x150mm (7x5.91")</option>
                                              <option class="ymm-li" value="8x6.5,8x165.1">8x6.5" (8x165.1mm)
                                              </option>
                                              <option class="ymm-li" value="8x6.69,8x170">8x170mm (8x6.69")</option>
                                              <option class="ymm-li" value="8x7.09,8x180">8x180mm (8x7.09")</option>
                                              <option class="ymm-li" value="8x7.87,8x200">8x200mm (8x7.87")</option>
                                              <option class="ymm-li" value="8x8.27,8x210">8x210mm (8x8.27")</option>
                                              <option class="ymm-li" value="10x225,10x8.85">10x225mm (10x8.85)
                                              </option>
                                              <option class="ymm-li" value="10x285.75,10x11.25">10x285.75mm
                                                  (10x11.25)</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="row justify-content-center">
                                      <div class="col-lg-12 text-center">
                                          <button type="submit" class="my-btn">Submit</button>
                                      </div>
                                  </div>
                              </div>
                          </form>
                      </li>



                      <li class="tab-content tab-content-3 typography">
                          <form action="<?php echo e(route('search')); ?>" method="POST" style="width: 100%;">
                              <?php echo csrf_field(); ?>
                              <input type="hidden" name="type" value="tire" id="">
                              <div class="row" style="justify-content: center;width: 100%;">
                                  <div class="col-lg-6" >
                                      <div class="input-group mb-3">
                                          <select class="form-select rounded-0" aria-label="Select Tire Height"
                                              name="tireHeight" id="tireHeightSelect">
                                              <option selected="">Tire Height</option>
                                              <option class="ymm-li" value="18">18"</option>
                                              <option class="ymm-li" value="22">22"</option>
                                              <option class="ymm-li" value="23">23"</option>
                                              <option class="ymm-li" value="24">24"</option>
                                              <option class="ymm-li" value="25">25"</option>
                                              <option class="ymm-li" value="26">26"</option>
                                              <option class="ymm-li" value="27">27"</option>
                                              <option class="ymm-li" value="28">28"</option>
                                              <option class="ymm-li" value="29">29"</option>
                                              <option class="ymm-li" value="30">30"</option>
                                              <option class="ymm-li" value="31">31"</option>
                                              <option class="ymm-li" value="32">32"</option>
                                              <option class="ymm-li" value="33">33"</option>
                                              <option class="ymm-li" value="34">34"</option>
                                              <option class="ymm-li" value="35">35"</option>
                                              <option class="ymm-li" value="35.5">35.5"</option>
                                              <option class="ymm-li" value="36">36"</option>
                                              <option class="ymm-li" value="37">37"</option>
                                              <option class="ymm-li" value="38">38"</option>
                                              <option class="ymm-li" value="38.5">38.5"</option>
                                              <option class="ymm-li" value="39">39"</option>
                                              <option class="ymm-li" value="39.5">39.5"</option>
                                              <option class="ymm-li" value="40">40"</option>
                                              <option class="ymm-li" value="41">41"</option>
                                              <option class="ymm-li" value="42">42"</option>
                                              <option class="ymm-li" value="42.5">42.5"</option>
                                              <option class="ymm-li" value="43">43"</option>
                                              <option class="ymm-li" value="44">44"</option>
                                              <option class="ymm-li" value="46">46"</option>
                                              <option class="ymm-li" value="47">47"</option>
                                              <option class="ymm-li" value="49">49"</option>
                                              <option class="ymm-li" value="54">54"</option>
                                              <option class="ymm-li" value="145">145mm</option>
                                              <option class="ymm-li" value="155">155mm</option>
                                              <option class="ymm-li" value="165">165mm</option>
                                              <option class="ymm-li" value="175">175mm</option>
                                              <option class="ymm-li" value="185">185mm</option>
                                              <option class="ymm-li" value="195">195mm</option>
                                              <option class="ymm-li" value="205">205mm</option>
                                              <option class="ymm-li" value="215">215mm</option>
                                              <option class="ymm-li" value="225">225mm</option>
                                              <option class="ymm-li" value="235">235mm</option>
                                              <option class="ymm-li" value="245">245mm</option>
                                              <option class="ymm-li" value="255">255mm</option>
                                              <option class="ymm-li" value="265">265mm</option>
                                              <option class="ymm-li" value="275">275mm</option>
                                              <option class="ymm-li" value="285">285mm</option>
                                              <option class="ymm-li" value="295">295mm</option>
                                              <option class="ymm-li" value="305">305mm</option>
                                              <option class="ymm-li" value="315">315mm</option>
                                              <option class="ymm-li" value="325">325mm</option>
                                              <option class="ymm-li" value="335">335mm</option>
                                              <option class="ymm-li" value="345">345mm</option>
                                              <option class="ymm-li" value="355">355mm</option>
                                              <option class="ymm-li" value="365">365mm</option>
                                              <option class="ymm-li" value="375">375mm</option>
                                              <option class="ymm-li" value="385">385mm</option>
                                              <option class="ymm-li" value="405">405mm</option>

                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-lg-6">
                                      <div class="input-group mb-3">
                                          <select class="form-select rounded-0" aria-label="Select Tire Width"
                                              name="tireWidth" id="tireWidthSelect">
                                              <option selected="">Tire Width</option>
                                              <option class="ymm-li" value="7">7"</option>
                                              <option class="ymm-li" value="8">8"</option>
                                              <option class="ymm-li" value="8.5">8.5"</option>
                                              <option class="ymm-li" value="9">9"</option>
                                              <option class="ymm-li" value="9.5">9.5"</option>
                                              <option class="ymm-li" value="10">10"</option>
                                              <option class="ymm-li" value="10.5">10.5"</option>
                                              <option class="ymm-li" value="11">11"</option>
                                              <option class="ymm-li" value="11.5">11.5"</option>
                                              <option class="ymm-li" value="12">12"</option>
                                              <option class="ymm-li" value="12.5">12.5"</option>
                                              <option class="ymm-li" value="13">13"</option>
                                              <option class="ymm-li" value="13.5">13.5"</option>
                                              <option class="ymm-li" value="14">14"</option>
                                              <option class="ymm-li" value="14.5">14.5"</option>
                                              <option class="ymm-li" value="15">15"</option>
                                              <option class="ymm-li" value="15.5">15.5"</option>
                                              <option class="ymm-li" value="16">16"</option>
                                              <option class="ymm-li" value="16.5">16.5"</option>
                                              <option class="ymm-li" value="18">18"</option>
                                              <option class="ymm-li" value="18.5">18.5"</option>
                                              <option class="ymm-li" value="19.5">19.5"</option>
                                              <option class="ymm-li" value="21">21"</option>
                                              <option class="ymm-li" value="25">25</option>
                                              <option class="ymm-li" value="30">30</option>
                                              <option class="ymm-li" value="35">35</option>
                                              <option class="ymm-li" value="40">40</option>
                                              <option class="ymm-li" value="45">45</option>
                                              <option class="ymm-li" value="50">50</option>
                                              <option class="ymm-li" value="55">55</option>
                                              <option class="ymm-li" value="60">60</option>
                                              <option class="ymm-li" value="65">65</option>
                                              <option class="ymm-li" value="70">70</option>
                                              <option class="ymm-li" value="75">75</option>
                                              <option class="ymm-li" value="80">80</option>
                                              <option class="ymm-li" value="85">85</option>

                                          </select>
                                      </div>
                                  </div>
                                  
                              </div>
                              <div class="mb-3">
                                 <div class="row justify-content-center">
                                    <div class="col-lg-12 text-center">
                                        <button type="submit" class="my-btn">Submit</button>
                                    </div>
                                </div>
                              </div>
                          </form>
                      </li>


                      <li class="tab-content tab-content-last typography">
                        <form action="<?php echo e(url('/gallery')); ?>" method="POST" style="width: 100%;">
                           <?php echo csrf_field(); ?>
                           <input type="hidden" name="type" value="gallery" id="">
                           <div class="row" style="justify-content: center;width: 100%;">
                               <div class="col-lg-3">
                                   <div class="input-group mb-3">
                                        <select class="form-select rounded-0" aria-label="Select Year" name="year" id="galleryYearSelect">
                                            <option selected="">Year</option>
                                            <?php
                                            $currentYear = date('Y');
                                            $startYear = 1948;
                                            
                                            for ($year = $currentYear; $year >= $startYear; $year--) {
                                                echo "<option value=\"$year\">$year</option>";
                                            }
                                            ?>
                                        </select>
                                   </div>
                               </div>
                               <div class="col-lg-3">
                                   <div class="input-group mb-3">
                                       <select class="form-select rounded-0" aria-label="Select Make"
                                           name="make" id="galleryMakeSelect">
                                           <option selected>Make</option>
                                       </select>
                                   </div>
                               </div>
                               <div class="col-lg-3">
                                   <div class="input-group mb-3">
                                       <select class="form-select rounded-0" aria-label="Select Model"
                                           name="model" id="galleryModelSelect">
                                           <option selected>Model</option>
                                       </select>
                                   </div>
                               </div>

                              <div class="col-lg-3">
                                <div class="input-group mb-3">
                                    <select class="form-select rounded-0" aria-label="Select Model" name="model" id="galleryModelSelect">
                                      <option value="">Suspension</option>
                                      <option value="">All</option>
                                      <option value="Air Suspension">Air Suspension</option>
                                      <option value="Coilovers">Coilovers</option>
                                      <option value="Lowering Springs">Lowering Springs</option>
                                      <option value="Stock">Stock</option>
                                      <option value="Lifted">Lifted</option>
                                    </select>
                                </div>
                              </div>

                               <div class="row justify-content-center">
                                   <div class="col-lg-12 text-center">
                                       <button type="submit" class="my-btn">Submit</button>
                                   </div>
                               </div>
                           </div>
                       </form>
                      </li>
                  </ul>
              </div>
              <!--/ tabs -->
          </div>
      </div>

      </div>
    </section>

    <section class="features">
      <div class="container">
        <div class="row mb-3">
          <div class="col-lg-6 mb-4 mb-lg-0">
            <div class="feature-box">
              <form action="<?php echo e(route('search')); ?>" method="GET">
                <div class="image" style="background-image: url('<?php echo e(env('ASSET_URL')); ?>/assets/images/features.jpg');">
                  <div class="text">
                    <h3 class="mb-3">WHEEL & TIRE PACKAGES</h3>
                      <input type="hidden" name="searchQuery" value="WHEEL TIRE Packages">
                    <button type="submit" class="my-btn">Discover More</button>
                  </div>
                </div>
              </form>

            </div>
          </div>
          <div class="col-lg-3 mb-4 mb-lg-0">
            <div class="feature-box">
              <form action="<?php echo e(route('search')); ?>" method="GET">
                
                  <div class="image" style="background-image: url('<?php echo e(env('ASSET_URL')); ?>/assets/images/features-1.jpg');">
                    <div class="text">
                      <h3 class="mb-3">TIRES</h3>
                      <input type="hidden" name="searchQuery" value="TIRES">
                      <button type="submit" class="my-btn">shop now</button>
                    </div>
                  </div>
              </form>
            </div>
          </div>
          <div class="col-lg-3 mb-4 mb-lg-0">
            <div class="feature-box">
              <form action="<?php echo e(route('search')); ?>" method="GET">
                
                <div class="image" style="background-image: url('<?php echo e(env('ASSET_URL')); ?>/assets/images/features-3.jpg');">
                  <div class="text">
                    <h3 class="mb-3">WHEELS</h3>
                    <input type="hidden" name="searchQuery" value="WHEELS">
                    <button type="submit" class="my-btn">shop now</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-3 mb-4 mb-lg-0">
            <div class="feature-box">
              <form action="<?php echo e(route('search')); ?>" method="GET">
                
                <div class="image" style="background-image: url('<?php echo e(env('ASSET_URL')); ?>/assets/images/features-4.jpg');">
                  <div class="text">
                    <h3 class="mb-3">SUSPENSION</h3>
                    <input type="hidden" name="searchQuery" value="SUSPENSION">
                    <button type="submit" class="my-btn">shop now</button>
                  </div>
                </div>
              </form>

            </div>
          </div>
          <div class="col-lg-3 mb-4 mb-lg-0">
            <div class="feature-box">
              <form action="<?php echo e(route('search')); ?>" method="GET">
                
                <div class="image" style="background-image: url('<?php echo e(env('ASSET_URL')); ?>/assets/images/features-5.jpg');">
                  <div class="text">
                    <h3 class="mb-3">LIGHTING</h3>
                    <input type="hidden" name="searchQuery" value="LIGHTING">
                    <button type="submit" class="my-btn">shop now</button>
                  </div>
                </div>
              </form>

            </div>
          </div>
          <div class="col-lg-6 mb-4 mb-lg-0">
            <div class="feature-box">
              <form action="<?php echo e(route('search')); ?>" method="GET">
                
                <div class="image" style="background-image: url('<?php echo e(env('ASSET_URL')); ?>/assets/images/features-6.jpg');">
                  <div class="text">
                    <h3 class="mb-3">EXTERIOR ACCESSORIES</h3>
                    <input type="hidden" name="searchQuery" value="EXTERIOR ACCESSORIES">
                    <button type="submit" class="my-btn">shop now</button>
                  </div>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="gallery">
      <div class="overlay"></div>
      <div class="container position-relative z-2">
        <div class="row">
          <div class="col-lg-10 mx-auto text-white text-center">
            <h2>Unleash Performance: Explore Our Premium Selection of Truck Upgrades.</h2>
            <p class="mb-4">Morbi accumsan sodales sociosqu curae egestas metus. Tellus nascetur egestas nunc consectetuer ullamcorper sodales dignissim montes ultricies rhoncus etiam. In maximus efficitur dignissim primis semper himenaeos pharetra.</p>
            <div class="w-100 text-start">
              <a href="<?php echo e(url('/gallery')); ?>" class="my-btn text-start">See our gallery</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="gallery-1">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
            <img src="<?php echo e(env('ASSET_URL')); ?>/assets/images/gallery.png" alt="" class="img-fluid">
          </div>
          <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
            <img src="<?php echo e(env('ASSET_URL')); ?>/assets/images/gallery-1.png" alt="" class="img-fluid">
          </div>
          <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
            <img src="<?php echo e(env('ASSET_URL')); ?>/assets/images/gallery-2.png" alt="" class="img-fluid">
          </div>
        </div>
      </div>
    </section>
    <section class="new-arrival">
      <div class="container">
        <div class="row mb-4">
          <div class="col-12 text-black">
            <h3 class="font-monsteret heading-color">NEW ARRIVAL PARTS</h3>
          </div>
        </div>
        <div class="row">
          <?php $__currentLoopData = $resultsCollection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-3 mb-5 col-md-6">
                <div class="product-box border">
                    <div class="image">
                        <!-- Check if images array exists and has elements -->
                        <?php if(isset($item['images']) && count($item['images']) > 0): ?>
                            <!-- Assuming the first image is used -->
                            <img src="<?php echo e($item['images'][0]['imageUrlOriginal']); ?>" alt="<?php echo e($item['title']); ?>" class="img-fluid">
                        <?php else: ?>
                            <!-- Handle case where no images are available -->
                            <img src="<?php echo e(asset('assets/images/no-image.png')); ?>" alt="Placeholder Image" class="img-fluid">
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
                              data-price="<?php echo e($item['prices']['msrp'][0]['currencyAmount']); ?>" 
                              data-image="<?php echo e($item['images'][0]['imageUrlOriginal']); ?>" 
                              data-vendor="Vendor Name">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </a>
                        </div>
                    </div>
                    <div class="text">
                        <h6>
                          <a href="<?php echo e(url('/wp-product-detail/'.$item['sku'])); ?>"><?php echo e($item['title']); ?></a>
                        </h6>
                        <!-- Assuming MSRP is present in the prices array -->
                        <?php if(isset($item['prices']['msrp'][0]['currencyAmount'])): ?>
                        <div class="price d-flex gap-2 justify-content-center align-items-center">
                            <!-- Real price is set to be 10% higher than the regular price -->
                            
                            <!-- Actual regular price -->
                            <p class="regular-price">$<?php echo e($item['prices']['msrp'][0]['currencyAmount']); ?></p>
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
                          <?php if(isset($item['images']) && count($item['images']) > 0): ?>
                              <!-- Assuming the first image is used -->
                              <img width="50%" src="<?php echo e($item['images'][0]['imageUrlOriginal']); ?>" alt="<?php echo e($item['title']); ?>" class="img-fluid">
                          <?php else: ?>
                              <!-- Handle case where no images are available -->
                              <img width="50%" src="<?php echo e(asset('assets/images/no-image.png')); ?>" alt="Placeholder Image" class="img-fluid">
                          <?php endif; ?>
                      </div>
                      <!-- Details Column -->
                      <div class="closest-input-quantity col-md-4 d-flex flex-column justify-content-center border-bottom">

                        <span class="card-title my-3" style="font-size: 28px;"><?php echo e($item['title']); ?></span>
                        <p class="card-text my-3">
                          
                          <span class="price current-price">$<?php echo e($item['prices']['msrp'][0]['currencyAmount']); ?></span>
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
                        data-price="<?php echo e($item['prices']['msrp'][0]['currencyAmount']); ?>" 
                        data-image="<?php echo e($item['images'][0]['imageUrlOriginal']); ?>" 
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
    </section>
    <section class="about-us">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <img src="<?php echo e(env('ASSET_URL')); ?>/assets/images/about.png" alt="" class="img-fluid w-100">
          </div>
          <div class="col-lg-6">
            <h4>ABOUT US</h4>
            <h5>THE ESSENCE OF <br> ENGINEERING, <br> FUELED BY PASSION </h5>
            <p class="mb-5">Gear up for the ultimate adventure – every mile, every upgrade, tailored just for you!</p>
            <div class="d-flex box mb-4 align-items-end gap-3">
              <img src="<?php echo e(env('ASSET_URL')); ?>/assets/images/about-1.png" alt="" class="img-fluid">
              <div>
                <h6 class="pt-3">AUTO PART STORE</h6>
                <p>Sit porta elementum laoreet phasellus duis nostra augue. Dictumst in porta inceptos maximus convallis</p>
              </div>
            </div>
            <div class="d-flex box align-items-end gap-3">
              <img src="<?php echo e(env('ASSET_URL')); ?>/assets/images/about-2.png" alt="" class="img-fluid">
              <div>
                <h6 class="pt-3">AUTO SERVICE</h6>
                <p>Sit porta elementum laoreet phasellus duis nostra augue. Dictumst in porta inceptos maximus convallis</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="comapnies">
      <div class="container">
        <div class="row">
          <div class="col-12 mb-4">
            <h3 class="font-monsteret heading-color">OUR AUTHORIZED DEALER</h3>
          </div>
          <div class="col-12">
            <div class="splide companies-splide" role="group" aria-label="Splide Basic HTML Example">
              <div class="splide__track">
                <ul class="splide__list">
                  <div class="splide__slide px-lg-3 px-md-2 px-0">
                    <div class="company-box">
                      <img src="<?php echo e(env('ASSET_URL')); ?>/assets/images/company (1).jpg" alt="" class="img-fluid">
                    </div>
                  </div>
                  <div class="splide__slide px-lg-3 px-md-2 px-0">
                    <div class="company-box">
                      <img src="<?php echo e(env('ASSET_URL')); ?>/assets/images/company (1).png" alt="" class="img-fluid">
                    </div>
                  </div>
                  <div class="splide__slide px-lg-3 px-md-2 px-0">
                    <div class="company-box">
                      <img src="<?php echo e(env('ASSET_URL')); ?>/assets/images/company (1).svg" alt="" class="img-fluid">
                    </div>
                  </div>
                  <div class="splide__slide px-lg-3 px-md-2 px-0">
                    <div class="company-box">
                      <img src="<?php echo e(env('ASSET_URL')); ?>/assets/images/company (1).webp" alt="" class="img-fluid">
                    </div>
                  </div>
                  <div class="splide__slide px-lg-3 px-md-2 px-0">
                    <div class="company-box">
                      <img src="<?php echo e(env('ASSET_URL')); ?>/assets/images/company (2).png" alt="" class="img-fluid">
                    </div>
                  </div>
                  <div class="splide__slide px-lg-3 px-md-2 px-0">
                    <div class="company-box">
                      <img src="<?php echo e(env('ASSET_URL')); ?>/assets/images/company (2).svg" alt="" class="img-fluid">
                    </div>
                  </div>
                  <div class="splide__slide px-lg-3 px-md-2 px-0">
                    <div class="company-box">
                      <img src="<?php echo e(env('ASSET_URL')); ?>/assets/images/company (3).png" alt="" class="img-fluid">
                    </div>
                  </div>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="testimonial">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 text-white">
            <h5 class="text-white">SMART AUTOMOTIVE FOR SMART PEOPLES</h5>
            <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
            <a href="#" class="my-btn">All Testimonials</a>
          </div>
          <div class="col-lg-6">
            <div class="splide testimonial-splide" role="group" aria-label="Splide Basic HTML Example" data-aos="fade-left" data-aos-duration="1000">
              <div class="splide__track">
                <ul class="splide__list">
                  <div class="splide__slide">
                    <div class="testimonial-box">
                      <ul class="ratings list-unstyled d-flex mb-3">
                        <li>
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li>
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li>
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li>
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li>
                          <i class="fas fa-star text-warning"></i>
                        </li>
                      </ul>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
                      <div class="d-flex mt-4 gap-3 align-items-center">
                        <div class="image">
                          <img src="<?php echo e(env('ASSET_URL')); ?>/assets/images/client.png" alt="" class="img-fluid">
                        </div>
                        <div class="text">
                          <p class="mb-0 name"> Harold K. Grimm</p>
                          <p class="mb-0">Semarang</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="splide__slide">
                    <div class="testimonial-box">
                      <ul class="ratings list-unstyled d-flex mb-3">
                        <li>
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li>
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li>
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li>
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li>
                          <i class="fas fa-star text-warning"></i>
                        </li>
                      </ul>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
                      <div class="d-flex mt-4 gap-3 align-items-center">
                        <div class="image">
                          <img src="<?php echo e(env('ASSET_URL')); ?>/assets/images/client-1.png" alt="" class="img-fluid">
                        </div>
                        <div class="text">
                          <p class="mb-0 name">George D. Coffey</p>
                          <p class="mb-0 ">Jakarta</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="splide__slide">
                    <div class="testimonial-box">
                      <ul class="ratings list-unstyled d-flex mb-3">
                        <li>
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li>
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li>
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li>
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li>
                          <i class="fas fa-star text-warning"></i>
                        </li>
                      </ul>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
                      <div class="d-flex mt-4 gap-3 align-items-center">
                        <div class="image">
                          <img src="<?php echo e(env('ASSET_URL')); ?>/assets/images/client-2.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="text">
                          <p class="mb-0 name">Frank Sinatra</p>
                          <p class=" mb-0">CEO</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="why-choose">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <h4 class="mb-3">WHY CHOOSE US</h4>
            <h5 class="mb-3">ENGINEERED FOR EXCELLENCE, CUSTOM WITH CARE</h5>
            <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
            <ul>
              <li>Aliquam ac dapibus lacinia dolor pharetra dui</li>
              <li>Sed adipiscing nostra ornare posuere pellentesque nisl egestas curae</li>
              <li>Vestibulum elit turpis letius fames fusce ornare lobortis vivamus</li>
              <li>Nec auctor ad nostra litora mollis integer dui letius efficitur</li>
              <li>Eu erat at laoreet orci lectus maximus bibendum senectus dolor</li>
            </ul>
          </div>
          <div class="col-lg-6">
            <img src="<?php echo e(env('ASSET_URL')); ?>/assets/images/why-choose.png" alt="" class="img-fluid">
          </div>
        </div>
      </div>
    </section>
    <section class="blogs">
      <div class="container">
        <div class="row mb-5">
          <div class="col-lg-12">
            <h3 class="font-monsteret heading-color mb-4">OUR LATEST BLOG</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
          </div>
        </div>
        <div class="row mb-5 pb-4">
          <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
            <div class="blog-box">
              <div class="image">
                <img src="<?php echo e(env('ASSET_URL')); ?>/assets/images/blog-1.png" alt="" class="img-fluid">
              </div>
              <div class="text">
                <h6 class="mb-0">
                  <a href="">EXTEND YOUR ENGINE’S LIFESPAN WITH THESE HELPFUL TIPS</a>
                </h6>
                <p class="info">November 23, 2023 // No Comments</p>
                <p class="description">Extend Your Engine’s Lifespan with These Helpful Tips Eros accumsan proin aliquet in mi sociosqu.Volutpat eu quam praesent ad ante. Commodoaugue faucibus felis vulputate leo</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
            <div class="blog-box">
              <div class="image">
                <img src="<?php echo e(env('ASSET_URL')); ?>/assets/images/blog-2.png" alt="" class="img-fluid">
              </div>
              <div class="text">
                <h6 class="mb-0">
                  <a href="">RECYCLING CARS – BENEFITS FOR ENVIRONMENT</a>
                </h6>
                <p class="info">November 23, 2023 // No Comments</p>
                <p class="description">Extend Your Engine’s Lifespan with These Helpful Tips Eros accumsan proin aliquet in mi sociosqu.Volutpat eu quam praesent ad ante. Commodoaugue faucibus felis vulputate leo</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
            <div class="blog-box">
              <div class="image">
                <img src="<?php echo e(env('ASSET_URL')); ?>/assets/images/blog-3.png" alt="" class="img-fluid">
              </div>
              <div class="text">
                <h6 class="mb-0">
                  <a href="">DON’T WAIT TO FIX YOUR ACCOMPRESSOR BEFORE IT GETS TOOHOT</a>
                </h6>
                <p class="info">November 23, 2023 // No Comments</p>
                <p class="description">Extend Your Engine’s Lifespan with These Helpful Tips Eros accumsan proin aliquet in mi sociosqu.Volutpat eu quam praesent ad ante. Commodoaugue faucibus felis vulputate leo</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-3">
            <div class="d-flex gap-4 align-items-start features-box">
              <div class="image">
                <img src="<?php echo e(env('ASSET_URL')); ?>/assets/images/icon.png" alt="" style="width: 4rem;" class="img-fluid">
              </div>
              <div class="text pt-3">
                <h6 class="mb-4">FREE SHIPPING</h6>
                <p>Donec eros laoreet auctor nostra in platea porttitor suscipit.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="d-flex gap-4 align-items-start features-box">
              <div class="image">
                <img src="<?php echo e(env('ASSET_URL')); ?>/assets/images/Icon-1.png" alt="" style="width: 4rem;" class="img-fluid">
              </div>
              <div class="text pt-3">
                <h6 class="mb-4">SECURE PAYMENT</h6>
                <p>Donec eros laoreet auctor nostra in platea porttitor suscipit.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="d-flex gap-4 align-items-start features-box">
              <div class="image">
                <img src="<?php echo e(env('ASSET_URL')); ?>/assets/images/Icon-2.png" alt="" style="width: 4rem;" class="img-fluid">
              </div>
              <div class="text pt-3">
                <h6 class="mb-4"> 30 DAYS WARRANTY</h6>
                <p>Donec eros laoreet auctor nostra in platea porttitor suscipit.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="d-flex gap-4 align-items-start features-box">
              <div class="image">
                <img src="<?php echo e(env('ASSET_URL')); ?>/assets/images/Icon-3.png" alt="" style="width: 4rem;" class="img-fluid">
              </div>
              <div class="text pt-3">
                <h6 class="mb-4"> 24/7 SUPPORT</h6>
                <p>Donec eros laoreet auctor nostra in platea porttitor suscipit.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>



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
      $('#galleryYearSelect').change(function() {
          var year = $(this).val();
          $.ajax({
              type: "GET",
              url: "<?php echo e(route('getMakes')); ?>",
              data: {
                  year: year
              },
              success: function(data) {
                  var makes = data;
                  var makeSelect = $('#galleryMakeSelect');
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

      $('#galleryMakeSelect').change(function() {
          var make = $(this).val();
          $.ajax({
              type: "GET",
              url: "<?php echo e(route('getModels')); ?>",
              data: {
                  make: make
              },
              success: function(data) {
                  var models = data;
                  var modelSelect = $('#galleryModelSelect');
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Hasnat Khan\Desktop\Diligenttek\liftnasium\resources\views/home.blade.php ENDPATH**/ ?>