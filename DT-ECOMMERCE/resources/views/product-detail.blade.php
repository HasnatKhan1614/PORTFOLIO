@extends('layouts.app')
 
@section('content')

    <section class="product-detail mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product-box border">
                        <div class="image text-start">
                            <img src="{{ $resultsArrayBySku['images'] }}" alt="" class="img-fluid">
                            {{-- <span>Sale !</span> --}}
                        </div>
                    </div>
                </div>
                <div class="closest-input-quantity col-lg-6">
                    <h1>{{$resultsArrayBySku['title']}}</h1>
                    {{-- @php
                        $realPrice = $resultsArrayBySku['prices'] * 1.1;
                    @endphp --}}
                    <div class="price">
                        {{-- <p class="cut">${{$realPrice}}</p> --}}
                        <p>${{$resultsArrayBySku['prices']}}</p>
                    </div>
                    <div class="d-flex align-items-center gap-4 mt-2 mb-3">
                        <div class="count d-flex align-items-center gap-3">
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
                        data-id="{{ $resultsArrayBySku['sku'] }}" 
                        data-name="{{ $resultsArrayBySku['title'] }}" 
                        data-price="{{$resultsArrayBySku['prices']}}" 
                        data-image="{{ $resultsArrayBySku['images'] }}" 
                        data-vendor="Vendor Name"
                        class="my-btn add-to-cart">ADD TO CART</button>
                    </div>
                    <p class="wish-list"><a href="#"><i class="fa-regular fa-heart me-2"></i>ADD TO WISHLIST</a></p>

                    <p class="category"><strong>Categories:</strong> <a href="#">Uncategorized</a></p>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"
                                aria-selected="true">reviews (0)</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                data-bs-target="#profile-tab-pane" type="button" role="tab"
                                aria-controls="profile-tab-pane" aria-selected="false">More Products</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                            aria-labelledby="home-tab" tabindex="0">
                            <p style="font-size: 14px; color: #757575;" class="mb-5">There are no reviews yet.</p>
                            <h3 style="font-size: 20px; font-weight: 700; color: #757575;">Be the first to
                                review “ALLOY RIM BLUE”</h3>
                            <form action="" class="review">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="review">Your review *</label>
                                            <textarea name="review" id="review" cols="30" rows="10"
                                                class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="name">Name *</label>
                                            <input type="text" id="name" name="name" value="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="email">Your review *</label>
                                            <input type="email" id="email" name="email" value="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit" class="my-btn">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                            tabindex="0">
                            <div class="row">
                            @foreach($randomResultsArray as $key => $item)
                                <div class="col-lg-3 mb-5 col-md-6">
                                    <div class="product-box border">
                                        <div class="image">
                                            <!-- Check if images array exists and has elements -->
                                            @if(isset($item['images']))
                                                <!-- Assuming the first image is used -->
                                                <img src="{{ $item['images'] }}" alt="{{ $item['title'] }}" class="img-fluid">
                                            @endif
                                            <span>Sale !</span>
                                            <div class="hidden-items">
                                                <a href="#" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#ProductDetail-{{$key}}" 
                                                data-bs-tooltip="tooltip" 
                                                data-bs-placement="top" 
                                                data-bs-title="Quick view" 
                                                data-bs-custom-class="custom-tooltip">
                                                  <i class="fa-solid fa-up-right-and-down-left-from-center"></i>
                                                </a>
                                                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add to Wishlist" data-bs-custom-class="custom-tooltip">
                                                    <i class="fa-regular fa-heart"></i>
                                                </a>
                                                <a href="#" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#shoppingCartModal"
                                                data-bs-placement="top" 
                                                data-bs-title="Add to Cart" 
                                                data-bs-custom-class="custom-tooltip"
                                                class="add-to-cart"
                                                data-id="{{ $item['sku'] }}" 
                                                data-name="{{ $item['title'] }}" 
                                                data-price="{{$item['prices']}}" 
                                                data-image="{{ $item['images'] }}" 
                                                data-vendor="Vendor Name">
                                                    <i class="fa-solid fa-cart-shopping"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="text">
                                            @if($item['vendorName'] == 'wheelpros')
                                            <h6>
                                              <a href="{{url('/wp-product-detail/'.$item['sku'])}}">{{ $item['title'] }}</a>
                                            </h6>
                                            @endif
                    
                                            @if($item['vendorName'] == 'roughcountry')
                                            <h6>
                                              <a href="{{url('/rc-product-detail/'.$item['sku'])}}">{{ $item['title'] }}</a>
                                            </h6>
                                            @endif
                                            <!-- Assuming MSRP is present in the prices array -->
                                            @if(isset($item['prices']))
                                            <div class="price d-flex gap-2 justify-content-center align-items-center">
                                                <!-- Real price is set to be 10% higher than the regular price -->
                                                {{-- @php
                                                    $realPrice = $item['prices'] * 1.1;
                                                @endphp --}}
                                                {{-- <p class="cut-price">${{ $realPrice }}</p> --}}
                                                <!-- Actual regular price -->
                                                <p class="regular-price">${{ $item['prices'] }}</p>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- Product Modal -->
                                <div class="modal fade custom-modal-width" id="ProductDetail-{{$key}}" tabindex="-1" role="dialog" aria-labelledby="ProductDetailTitle" aria-hidden="true">
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
                                            @if(isset($item['images']))
                                                <img src="{{ $item['images'] }}" alt="{{ $item['title'] }}" class="img-fluid">
                                            @endif
                                            </div>
                                            <!-- Details Column -->
                                            <div class="closest-input-quantity col-md-4 d-flex flex-column justify-content-center border-bottom">
                    
                                            <span class="card-title my-3" style="font-size: 28px;">{{ $item['title'] }}</span>
                                            <p class="card-text my-3">
                                                {{-- <span class="price original-price">${{$realPrice}}</span> --}}
                                                <span class="price current-price">${{ $item['prices'] }}</span>
                                            </p>
                                            <div class="count d-flex align-items-center gap-3 p-3">
                                                <button type="button" class="decrement">-</button>
                                                    <p class="number quantity-input">1</p>
                                                <button type="button" class="increment">+</button>
                                            </div>
                                            {{-- <div class="d-flex align-items-center mb-2">
                                                <button class="btn btn-outline-secondary btn-quantity" onclick="updateQuantity(-1)">-</button>
                                                <input type="number" id="quantity" class="form-control mx-2 quantity-input" min="1" style="width: 60px; text-align: center;">
                                                <button class="btn btn-outline-secondary btn-quantity" onclick="updateQuantity(1)">+</button>
                                            </div> --}}
                                            <button
                                            data-bs-toggle="modal"
                                            data-bs-target="#shoppingCartModal"
                                            data-bs-placement="top"
                                            data-bs-title="Add to Cart"
                                            data-bs-custom-class="custom-tooltip"
                                            data-id="{{ $item['sku'] }}"
                                            data-name="{{ $item['title'] }}"
                                            data-price="{{$item['prices']}}" 
                                            data-image="{{ $item['images'] }}" 
                                            data-vendor="Vendor Name"
                                            class="add-to-cart my-btn"
                                            >Add to Cart</button>
                                            <div class="d-flex align-items-center my-2">
                                                <i class="fa fa-heart"></i>
                                            </div>
                                            <div class="d-flex align-items-center mt-2">
                                                <span>Categories: {{$item['skuType']}}</span>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                        
                    
                                        {{-- <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                        </div> --}}
                                    </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

@endsection