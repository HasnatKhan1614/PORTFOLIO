@extends('layouts.app')


<link href="https://images.enthusiastenterprises.us/css/revamp/min/global.min.2.26.13.css" rel="stylesheet" />
<link href="https://images.enthusiastenterprises.us/css/revamp/min/ymm-landing.min.2.0.8.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
@section('content')
    <div id='co-banneroffset'>
        <div>
            <div id="gallery-slider-wrap-images" class="gallery-detail-wrapper-images">
              <ul class="slider slider-nav-images">
                @isset($data->image1)
                <div class="gal-bg">
                    <img class="img-fluid" data-srcset="{{ asset('storage/'.$data->image1) }}" src="{{ asset('storage/'.$data->image1) }}" />
                </div>
                @endisset
                @isset($data->image2)
                    <div class="gal-bg">
                        <img class="img-fluid" data-srcset="{{ asset('storage/'.$data->image2) }}" src="{{ asset('storage/'.$data->image2) }}" />
                    </div>
                @endisset
                @isset($data->image3)
                    <div class="gal-bg">
                        <img class="img-fluid" data-srcset="{{ asset('storage/'.$data->image3) }}" src="{{ asset('storage/'.$data->image3) }}" />
                    </div>
                @endisset
                @isset($data->image4)
                    <div class="gal-bg">
                        <img class="img-fluid" data-srcset="{{ asset('storage/'.$data->image4) }}" src="{{ asset('storage/'.$data->image4) }}" />
                    </div>
                @endisset
                @isset($data->image5)
                    <div class="gal-bg">
                        <img class="img-fluid" data-srcset="{{ asset('storage/'.$data->image5) }}" src="{{ asset('storage/'.$data->image5) }}" />
                    </div>
                @endisset
                @isset($data->image6)
                    <div class="gal-bg">
                        <img class="img-fluid" data-srcset="{{ asset('storage/'.$data->image6) }}" src="{{ asset('storage/'.$data->image6) }}" />
                    </div>
                @endisset
                @isset($data->image7)
                    <div class="gal-bg">
                        <img class="img-fluid" data-srcset="{{ asset('storage/'.$data->image7) }}" src="{{ asset('storage/'.$data->image7) }}" />
                    </div>
                @endisset
                @isset($data->image8)
                    <div class="gal-bg">
                        <img class="img-fluid" data-srcset="{{ asset('storage/'.$data->image8) }}" src="{{ asset('storage/'.$data->image8) }}" />
                    </div>
                @endisset
              </ul>
              <div class="gal-slider-images">
                <div class="slider slider-for-images">
                  <div class="gal-main">
                    <img class="img-fluid" data-srcset="{{ asset('storage/'.$data->image1) }}" src="{{ asset('storage/'.$data->image1) }}" />
                  </div>
                  <div class="gal-main">
                    <img class="img-fluid" data-srcset="{{ asset('storage/'.$data->image2) }}" src="{{ asset('storage/'.$data->image2) }}" />
                  </div>
                  <div class="gal-main">
                    <img class="img-fluid" data-srcset="{{ asset('storage/'.$data->image3) }}" src="{{ asset('storage/'.$data->image3) }}" />
                  </div>
                  <div class="gal-main">
                    <img class="img-fluid" data-srcset="{{ asset('storage/'.$data->image4) }}" src="{{ asset('storage/'.$data->image4) }}" />
                  </div>
                  <div class="gal-main">
                    <img class="img-fluid" data-srcset="{{ asset('storage/'.$data->image5) }}" src="{{ asset('storage/'.$data->image5) }}" />
                  </div>
                  <div class="gal-main">
                    <img class="img-fluid" data-srcset="{{ asset('storage/'.$data->image6) }}" src="{{ asset('storage/'.$data->image6) }}" />
                  </div>
                  <div class="gal-main">
                    <img class="img-fluid" data-srcset="{{ asset('storage/'.$data->image7) }}" src="{{ asset('storage/'.$data->image7) }}" />
                  </div>
                  <div class="gal-main">
                    <img class="img-fluid" data-srcset="{{ asset('storage/'.$data->image8) }}" src="{{ asset('storage/'.$data->image8) }}" />
                  </div>
                </div>
                {{-- <div class="icons">
                  <a class='remove-btn' href='/wheel-offset-gallery/2967988/2024-gmc-sierra-1500-fuel-covert-readylift-leveling-kit-nitto-recon-grappler-a-t' data-id="2967988" data-email="" data-site="co" style="display: none" onclick="return removeBtn();">
                      <svg
                          xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.244 22.106">
                          <path d="M8188.233,860.9v18.939l9.119-7.772,9.125,7.772V860.9Z" transform="translate(-8187.233 -859.896)" style="fill: #fff" />
                      </svg> Save 
                  </a>
                  <a class='save-btn' href=/auth/login?t=user&request_url=%2Fwheel-offset-gallery%2F2967988%2F2024-gmc-sierra-1500-fuel-covert-readylift-leveling-kit-nitto-recon-grappler-a-t style="display: " onclick="return saveBtn();">
                      <svg
                          xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.244 22.106">
                          <path d="M8188.233,860.9v18.939l9.119-7.772,9.125,7.772V860.9Z" transform="translate(-8187.233 -859.896)" />
                      </svg> Save 
                  </a>
                  <a class='share-btn'>
                      <svg
                          xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25.437 23.174">
                          <path d="M394.937,413.709l-7.851-7.851a.851.851,0,0,0-1.452.6v3.2a13.8,13.8,0,0,0-13.67,15.481,16.983,16.983,0,0,1,13.67-6.459v3.482a.851.851,0,0,0,1.452.6l7.851-7.851A.851.851,0,0,0,394.937,413.709Z" transform="translate(-370.861 -404.583)" />
                      </svg> Share 
                  </a>
              </div> --}}
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
            {{-- <div class="breadcrumbs-container">
                <nav class="breadcrumbs-wrapper">
                    <ol style="margin:0;" class="breadcrumbs" itemscope itemtype="https://schema.org/BreadcrumbList">
                        <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                            itemtype="https://schema.org/ListItem">
                            <a itemprop="item" href="/"><span itemprop="name">Home</span></a>
                            <meta itemprop="position" content="1">
                        </li>
                        <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                            itemtype="https://schema.org/ListItem">
                            <a id="back2gallery" itemprop="item" href="/wheel-offset-gallery?newresults=1"><span
                                    itemprop="name">Custom Offsets Gallery</span></a>
                            <meta itemprop="position" content="2">
                        </li>
                        <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                            itemtype="https://schema.org/ListItem">
                            <a itemprop="item" href="/wheel-offset-gallery?make=GMC&newresults=m"><span
                                    itemprop="name">GMC</span></a>
                            <meta itemprop="position" content="3">
                        </li>
                        <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                            itemtype="https://schema.org/ListItem">
                            <a itemprop="item" href="/wheel-offset-gallery?make=GMC&model=Sierra+1500&newresults=mm"><span
                                    itemprop="name">Sierra 1500</span></a>
                            <meta itemprop="position" content="4">
                        </li>
                        <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                            itemtype="https://schema.org/ListItem">
                            <a itemprop="item" href="/wheel-offset-gallery?year=2024&make=GMC&model=Sierra+1500"><span
                                    itemprop="name">2024 GMC Sierra 1500</span></a>
                            <meta itemprop="position" content="5">
                        </li>
                    </ol>
                </nav>
            </div> --}}
            <div class="title-container">
                <div class="owner-photographer">

                </div>
                <h1>{{ $data->year }} {{ $data->make }} {{ $data->model }}<br><span><span></h1>
            </div>
            {{-- <div class='products-container'>
                <div class='product-card-container'>
                    <h2>Explore These Products</h2>
                    <div id='product-slider-wrap' class='product-slider-detail'>
                        <div class='product-card-row product-slider'>
                            <div class="card">
                                <p class="price-package" style="background-color: var(--site-accent-mid);"><b>3176.00</b>
                                </p>
                                <p class="original-price-package" style="color: var(--site-accent-mid);"><b>$2966.84</b>
                                </p>
                                <div class="image-container">
                                    <a href="/buy-wheel-offset/D69418908450/fuel-covert?year=2024&make=GMC&model=Sierra+1500&drive=4WD&trim=AT4"
                                        class="wt-package-img">
                                        <img src="https://images.customwheeloffset.com/wheels/fuel/covert/covert_black_white.jpg"
                                            alt="Fuel Covert" title="Fuel Covert" />
                                    </a>
                                    <a href="/buy-wheel-offset2/218610/nitto-recon-grappler-a-t-295-70r18-tires&year=2024&make=GMC&model=Sierra+1500&drive=4WD&trim=AT4"
                                        class="wt-package-img">
                                        <img src='https://images.customwheeloffset.com/tires/nitto/recongrapplerat/recongrapplerat_white_top3.jpg'
                                            alt="Nitto Recon Grappler A-t" title="Nitto Recon Grappler A-t" />
                                    </a>
                                </div>
                                <div class="product-info-container">
                                    <div class="product-container">
                                        <div class="wt-package-info">
                                            <p class="wheels-product">Fuel Covert</p>
                                            <p>18x9 +1</p>
                                        </div>
                                        <div class="wt-package-info">
                                            <p class="tires-product">Nitto Recon Grappler A/t</p>
                                            <p>295/70R18</p>
                                        </div>
                                    </div>
                                </div>
                                <a href="/buy-wheel-offset2/D69418908450/218610/fuel+covert+nitto+recon+grappler+a-t?year=2024&make=GMC&model=Sierra+1500&drive=4WD&trim=AT4"
                                    class="buy-btn-container">
                                    <div id='packages-button'class="exact-btn"
                                        style="background-color: var(--site-accent-mid);">
                                        <div class='buy-similar'>Buy Exact Package</div>
                                    </div>
                                </a>
                            </div>
                            <a href='/store/suspension/leveling-kits?year=2024&make=GMC&model=Sierra+1500&drive=4WD&trim=AT4'
                                class="card">
                                <div class="product-info-container generic-img">
                                    <div class="shop-title-container">
                                        <p class="shop-title">Shop Leveling Kits</p>
                                    </div>
                                    <div class="generic-image-container">
                                        <img
                                            src="https://images.customwheeloffset.com/buy2-compressed/web/7665-1-25-leveling-kit-ford-f-150.jpg" />
                                    </div>
                                </div>
                                <div class="buy-btn-container buy-suspension">
                                    <div class="exact-btn" style="background-color: var(--site-accent-mid);">Shop
                                        Suspension</div>
                                </div>
                            </a>
                            <a class="card all-products" href="/2024-GMC-Sierra-1500">
                                <div id='shop-all-parts' class="shop-product-container">
                                    <p class="product-container-text">Shop All Accessories</p>
                                    <p>2024 GMC Sierra 1500</p>
                                    <img src="https://images.enthusiastenterprises.us/svg/green-plus-icon.svg"
                                        alt="green-plus-icon" class="green-plus-icon">
                                </div>
                            </a>
                        </div>
                    </div>
                    <a class='shop-this-fitment' style='background-color: var(--site-accent-mid);'
                        href='/store/wheels/2024-GMC-Sierra-1500?dia=18&width=9&offset=1&wheel_stance=Slightly Aggressive&ratio_from=70&width_from=295&diameter_from=295&bolt_patterns=6x5.5&shopfitment=same&verifyShopFitment=1'>Shop
                        This Fitment</a>
                </div>
            </div> --}}

            <div class='about-this-build'>
                <h2>About this Build</h2>
                <div class='about-this-build-info'>
                    <div class='from-the-owner'>
                        <a id='from-the-owner-info'>
                            <h4 class='gallery-build-section-detials'>Vehicle Details:</h4>
                            {{ $data->vehicle_details }}
                        </a>
                    </div>
                    <div class='rubbing-trimming-spacers'>
                        <h4>Rubbing:</br><span>{{ $data->rubbing }}</span></h4>
                        </br>
                        <h4>Trimming:</br><span>{{ $data->modification }}</span></h4>
                        </br>
                        <h4>Front Wheel Spacers:</br><span>{{ $data->front_wheel_spacers }}</span></h4>
                        </br>
                        {{-- <h4>Rear Wheel Spacers:</br><span>None</span></h4> --}}
                        {{-- </br> --}}
                        <h4>Stance:</br><span>{{ $data->type_of_stance }}</span></h4>
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
                {{-- <tr class='accordion-content-wheel h3-product-name'>
                    <td class='td-col2' colspan='2'>
                        <h3><a href="/brands/wheels/Fuel/Covert">Fuel Covert - Black
                        </h3>
                    </td>
                </tr> --}}
                <tr class='accordion-content-wheel'>
                    <td class='first-columm'>
                        <h4>Front: <a href='#' class='url-size'>{{ $data->front_wheel }}</a></h4><br />
                        <h4>Offset:
                            <p>{{ $data->offset_wheel }}</p>
                        </h4><br />
                        <h4>Backspacing:
                            <p>{{ $data->backspacing_wheel }}</p>
                        </h4><br />
                    </td>
                    <td class='second-columm'>
                        <h4>Rear: <a href='#' class='url-size'>{{ $data->rear_wheel }}</a></h4><br />
                        <h4>Offset:
                            <p>{{ $data->offset_wheel }}</p><br />
                            <h4>Backspacing:
                                <p>{{ $data->backspacing_wheel }}</p>
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
                        <h4>Front:<br /><a href='#' class='url-size'>{{ $data->front_tire }}<br /></a></h4>
                    </td>
                    <td>
                        <div class='second-columm-r'>
                            <h4>Rear:<br /><a href='#' class='url-size'>{{ $data->rear_tire }}<br /></a>
                            </h4>
                        </div>
                    </td>
                </tr>
                <th colspan='2' id='accordion-suspension' class='th-col2'>
                    <h2>Suspension Info</h2>
                </th>
                <tr class='accordion-content-suspension'>
                    <td class='first-columm'>
                        <h4>Brand:<a href='#' class='url-size'>{{ $data->brand_suspension }}</a></h4>
                    </td>
                    <td class='second-columm'>
                        <h4>Suspension:<a href='#' class='url-size'>{{ $data->suspension }}</a></h4>
                    </td>
            </table>
            {{-- <div id='similar-vehicle-container'>
                <h2>similar {{ $data->year }} {{ $data->make }} {{ $data->model }}</h2>  
                <div class="similar-vehicle-wrapper">
                    <div class='sim-vehicle-slider'>
                        <div class='similar-vehicle'>
                            <div class="similar-main-image-container">
                                <a href='/wheel-offset-gallery/2894320/2024-gmc-sierra-1500-fuel-catalyst-zone-suspension-lift-6in'
                                    class="sim-img-wrapper"
                                    style="background: linear-gradient(rgba(0, 0, 0, 0.7),rgba(0, 0, 0, 0.7)), url(https://images.customwheeloffset.com/thumb/2894320-1-2024-sierra-1500-gmc-denali-zone-suspension-lift-6in-fuel-catalyst-matte-black.jpg)">
                                    <img src="https://images.customwheeloffset.com/thumb/2894320-1-2024-sierra-1500-gmc-denali-zone-suspension-lift-6in-fuel-catalyst-matte-black.jpg"
                                        alt="Fuel Catalyst 22x12 -44" title="Fuel Catalyst 22x12 -44" />
                                </a>
                            </div>
                            <div class="sim-text-wrapper">
                                <p class='vehicle-ymm'>2024 GMC Sierra 1500</p>
                                <p class='similar-vehicle-info'>Fuel Catalyst 22x12 -44</p>
                                <p class='similar-vehicle-info'>Milestar Patagonia M/t 35x12.5</p>
                                <a href='/wheel-offset-gallery/2894320/2024-gmc-sierra-1500-fuel-catalyst-zone-suspension-lift-6in'
                                    class='view-vehicle-btn'>View Truck</a>
                            </div>
                        </div>
                        <div class='similar-vehicle'>
                            <div class="similar-main-image-container">
                                <a href='/wheel-offset-gallery/2906629/2024-gmc-sierra-1500-fuel-clash-maxxride-leveling-kit'
                                    class="sim-img-wrapper"
                                    style="background: linear-gradient(rgba(0, 0, 0, 0.7),rgba(0, 0, 0, 0.7)), url(https://images.customwheeloffset.com/thumb/2906629-1-2024-sierra-1500-gmc-pro-maxxride-leveling-kit-fuel-clash-gloss-black.jpg)">
                                    <img src="https://images.customwheeloffset.com/thumb/2906629-1-2024-sierra-1500-gmc-pro-maxxride-leveling-kit-fuel-clash-gloss-black.jpg"
                                        alt="Fuel Clash 20x10 -18" title="Fuel Clash 20x10 -18" />
                                </a>
                            </div>
                            <div class="sim-text-wrapper">
                                <p class='vehicle-ymm'>2024 GMC Sierra 1500</p>
                                <p class='similar-vehicle-info'>Fuel Clash 20x10 -18</p>
                                <p class='similar-vehicle-info'>Nitto Recon Grappler A/t 285x55</p>
                                <a href='/wheel-offset-gallery/2906629/2024-gmc-sierra-1500-fuel-clash-maxxride-leveling-kit'
                                    class='view-vehicle-btn'>View Truck</a>
                            </div>
                        </div>
                        <div class='similar-vehicle'>
                            <div class="similar-main-image-container">
                                <a href='/wheel-offset-gallery/2914581/2024-gmc-sierra-1500-hardrock-affliction-rough-country-leveling-kit'
                                    class="sim-img-wrapper"
                                    style="background: linear-gradient(rgba(0, 0, 0, 0.7),rgba(0, 0, 0, 0.7)), url(https://images.customwheeloffset.com/thumb/2914581-1-2024-sierra-1500-gmc-elevation-rough-country-leveling-kit-hardrock-affliction-gloss-black.jpg)">
                                    <img src="https://images.customwheeloffset.com/thumb/2914581-1-2024-sierra-1500-gmc-elevation-rough-country-leveling-kit-hardrock-affliction-gloss-black.jpg"
                                        alt="Hardrock Affliction 20x10 -19" title="Hardrock Affliction 20x10 -19" />
                                </a>
                            </div>
                            <div class="sim-text-wrapper">
                                <p class='vehicle-ymm'>2024 GMC Sierra 1500</p>
                                <p class='similar-vehicle-info'>Hardrock Affliction 20x10 -19</p>
                                <p class='similar-vehicle-info'>Nitto Trail Grappler 33x12.5</p>
                                <a href='/wheel-offset-gallery/2914581/2024-gmc-sierra-1500-hardrock-affliction-rough-country-leveling-kit'
                                    class='view-vehicle-btn'>View Truck</a>
                            </div>
                        </div>
                        <div class='similar-vehicle'>
                            <div class="similar-main-image-container">
                                <a href='/wheel-offset-gallery/2935259/2024-gmc-sierra-1500-kmc-km722-rough-country-leveling-kit'
                                    class="sim-img-wrapper"
                                    style="background: linear-gradient(rgba(0, 0, 0, 0.7),rgba(0, 0, 0, 0.7)), url(https://images.customwheeloffset.com/thumb/2935259-1-2024-sierra-1500-gmc-denali-ultimate-rough-country-leveling-kit-kmc-km722-satin-black.jpg)">
                                    <img src="https://images.customwheeloffset.com/thumb/2935259-1-2024-sierra-1500-gmc-denali-ultimate-rough-country-leveling-kit-kmc-km722-satin-black.jpg"
                                        alt="KMC Km722 20x9 18" title="KMC Km722 20x9 18" />
                                </a>
                            </div>
                            <div class="sim-text-wrapper">
                                <p class='vehicle-ymm'>2024 GMC Sierra 1500</p>
                                <p class='similar-vehicle-info'>KMC Km722 20x9 18</p>
                                <p class='similar-vehicle-info'>Bridgestone Dueler A/T Revo 3 33x12.5</p>
                                <a href='/wheel-offset-gallery/2935259/2024-gmc-sierra-1500-kmc-km722-rough-country-leveling-kit'
                                    class='view-vehicle-btn'>View Truck</a>
                            </div>
                        </div>
                        <div class='similar-vehicle'>
                            <div class="similar-main-image-container">
                                <a href='/wheel-offset-gallery/2959228/2024-gmc-sierra-1500-fuel-flame-6-bds-suspension-suspension-lift-6in'
                                    class="sim-img-wrapper"
                                    style="background: linear-gradient(rgba(0, 0, 0, 0.7),rgba(0, 0, 0, 0.7)), url(https://images.customwheeloffset.com/thumb/2959228-1-2024-sierra-1500-gmc-slt-bds-suspension-lift-6in-fuel-flame-6-matte-black.jpg)">
                                    <img src="https://images.customwheeloffset.com/thumb/2959228-1-2024-sierra-1500-gmc-slt-bds-suspension-lift-6in-fuel-flame-6-matte-black.jpg"
                                        alt="Fuel Flame 6 20x9 20" title="Fuel Flame 6 20x9 20" />
                                </a>
                            </div>
                            <div class="sim-text-wrapper">
                                <p class='vehicle-ymm'>2024 GMC Sierra 1500</p>
                                <p class='similar-vehicle-info'>Fuel Flame 6 20x9 20</p>
                                <p class='similar-vehicle-info'>Nitto Mud Grappler 35x12.5</p>
                                <a href='/wheel-offset-gallery/2959228/2024-gmc-sierra-1500-fuel-flame-6-bds-suspension-suspension-lift-6in'
                                    class='view-vehicle-btn'>View Truck</a>
                            </div>
                        </div>
                        <div class='similar-vehicle'>
                            <div class="similar-main-image-container">
                                <a href='/wheel-offset-gallery/2971072/2024-gmc-sierra-1500-anthem-off-road-turbine-rough-country-suspension-lift-3.5in'
                                    class="sim-img-wrapper"
                                    style="background: linear-gradient(rgba(0, 0, 0, 0.7),rgba(0, 0, 0, 0.7)), url(https://images.customwheeloffset.com/thumb/2971072-1-2024-sierra-1500-gmc-elevation-rough-country-suspension-lift-35in-anthem-off-road-turbine-gloss-black.jpg)">
                                    <img src="https://images.customwheeloffset.com/thumb/2971072-1-2024-sierra-1500-gmc-elevation-rough-country-suspension-lift-35in-anthem-off-road-turbine-gloss-black.jpg"
                                        alt="Anthem Off-Road Turbine 20x10 -24"
                                        title="Anthem Off-Road Turbine 20x10 -24" />
                                </a>
                            </div>
                            <div class="sim-text-wrapper">
                                <p class='vehicle-ymm'>2024 GMC Sierra 1500</p>
                                <p class='similar-vehicle-info'>Anthem Off-Road Turbine 20x10 -24</p>
                                <p class='similar-vehicle-info'>Falken Wildpeak Rt01 33x12.5</p>
                                <a href='/wheel-offset-gallery/2971072/2024-gmc-sierra-1500-anthem-off-road-turbine-rough-country-suspension-lift-3.5in'
                                    class='view-vehicle-btn'>View Truck</a>
                            </div>
                        </div>
                        <div class='similar-vehicle'>
                            <div class="similar-main-image-container">
                                <a href='/wheel-offset-gallery/2973702/2024-gmc-sierra-1500-dub-8-ball-stock-stock'
                                    class="sim-img-wrapper"
                                    style="background: linear-gradient(rgba(0, 0, 0, 0.7),rgba(0, 0, 0, 0.7)), url(https://images.customwheeloffset.com/thumb/2973702-1-2024-sierra-1500-gmc-elevation-stock-stock-dub-8-ball-machined-black.jpg)">
                                    <img src="https://images.customwheeloffset.com/thumb/2973702-1-2024-sierra-1500-gmc-elevation-stock-stock-dub-8-ball-machined-black.jpg"
                                        alt="DUB 8 Ball 22x9.5 20" title="DUB 8 Ball 22x9.5 20" />
                                </a>
                            </div>
                            <div class="sim-text-wrapper">
                                <p class='vehicle-ymm'>2024 GMC Sierra 1500</p>
                                <p class='similar-vehicle-info'>DUB 8 Ball 22x9.5 20</p>
                                <p class='similar-vehicle-info'>Toyo Tires Open Country A/t Iii 33x12.5</p>
                                <a href='/wheel-offset-gallery/2973702/2024-gmc-sierra-1500-dub-8-ball-stock-stock'
                                    class='view-vehicle-btn'>View Truck</a>
                            </div>
                        </div>
                        <div class='similar-vehicle'>
                            <div class="similar-main-image-container">
                                <a href='/wheel-offset-gallery/2985387/2024-gmc-sierra-1500-gear-off-road-edge-cognito-suspension-lift-3in'
                                    class="sim-img-wrapper"
                                    style="background: linear-gradient(rgba(0, 0, 0, 0.7),rgba(0, 0, 0, 0.7)), url(https://images.customwheeloffset.com/thumb/2985387-1-2024-sierra-1500-gmc-elevation-unknown-suspension-lift-35in-gear-off-road-edge-gloss-black.jpg)">
                                    <img src="https://images.customwheeloffset.com/thumb/2985387-1-2024-sierra-1500-gmc-elevation-unknown-suspension-lift-35in-gear-off-road-edge-gloss-black.jpg"
                                        alt="Gear Off-Road Edge 22x10 -19" title="Gear Off-Road Edge 22x10 -19" />
                                </a>
                            </div>
                            <div class="sim-text-wrapper">
                                <p class='vehicle-ymm'>2024 GMC Sierra 1500</p>
                                <p class='similar-vehicle-info'>Gear Off-Road Edge 22x10 -19</p>
                                <p class='similar-vehicle-info'>TIS Tt1 33x12.5</p>
                                <a href='/wheel-offset-gallery/2985387/2024-gmc-sierra-1500-gear-off-road-edge-cognito-suspension-lift-3in'
                                    class='view-vehicle-btn'>View Truck</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="additional-information-seo">
                <h2> Additional Information </h2>
                {{ $data->additional_information }}
            </div>
        </div>
    </div>
@endsection

@section('script')
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
@endsection
