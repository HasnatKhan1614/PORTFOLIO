@extends('layouts.app')
@section('content')

<section class="aboutus-banner mb-5">
    <div class="overlay"></div>
    <div class="container z-2 position-relative">
        <div class="row">
            <div class="col-lg-12 text-center"> <!-- Added text-center class -->
                <h1>BLOG</h1>
                {{-- <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p> --}}
                {{-- <a href="#" class="my-btn">shop now!</a> --}}
            </div>
        </div>
    </div>
</section>

<section>
  <div class="container my-5">
    <div class="row mb-4">
      <div class="col-12 text-black">
        <h5 class="font-monsteret heading-color">BLOGS</h5>
      </div>
    </div>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

      <div class="col">
        <a href="{{ url('blog-detail') }}">
          <div class="card shadow-sm">
            <img src="{{ env('ASSET_URL') }}/assets/images/gallery.png" alt="" width="100%" height="225">
            <div class="card-body">
              <a href="{{ url('blog-detail') }}"><div class="h5 text-dark">Lorem Ipsum</div></a>
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  {{-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> --}}
                </div>
                <small class="text-body-secondary">9 mins</small>
              </div>
            </div>
          </div>
        </a>
      </div>

      <div class="col">
        <a href="{{ url('blog-detail') }}">
          <div class="card shadow-sm">
            <img src="{{ env('ASSET_URL') }}/assets/images/gallery-1.png" alt="" width="100%" height="225">
            <div class="card-body">
              <a href="{{ url('blog-detail') }}"><div class="h5 text-dark">Lorem Ipsum</div></a>
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  {{-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> --}}
                </div>
                <small class="text-body-secondary">9 mins</small>
              </div>
            </div>
          </div>
        </a>
      </div>

      <div class="col">
        <a href="{{ url('blog-detail') }}">
          <div class="card shadow-sm">
            <img src="{{ env('ASSET_URL') }}/assets/images/gallery-2.png" alt="" width="100%" height="225">
            <div class="card-body">
              <a href="{{ url('blog-detail') }}"><div class="h5 text-dark">Lorem Ipsum</div></a>
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  {{-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> --}}
                </div>
                <small class="text-body-secondary">9 mins</small>
              </div>
            </div>
          </div>
        </a>
      </div>

      <div class="col">
        <a href="{{ url('blog-detail') }}">
          <div class="card shadow-sm">
            <img src="{{ env('ASSET_URL') }}/assets/images/gallery-banner.jpg" alt="" width="100%" height="225">
            <div class="card-body">
              <a href="{{ url('blog-detail') }}"><div class="h5 text-dark">Lorem Ipsum</div></a>
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  {{-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> --}}
                </div>
                <small class="text-body-secondary">9 mins</small>
              </div>
            </div>
          </div>
        </a>
      </div>

      <div class="col">
        <a href="{{ url('blog-detail') }}">
        <div class="card shadow-sm">
          <img src="{{ env('ASSET_URL') }}/assets/images/gallery-bg.png" alt="" width="100%" height="225">
          <div class="card-body">
            <a href="{{ url('blog-detail') }}"><div class="h5 text-dark">Lorem Ipsum</div></a>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                {{-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> --}}
              </div>
              <small class="text-body-secondary">9 mins</small>
            </div>
          </div>
        </div>
        </a>
      </div>

      <div class="col">
        <a href="{{ url('blog-detail') }}">
        <div class="card shadow-sm">
          <img src="{{ env('ASSET_URL') }}/assets/images/shop-banner.jpg" alt="" width="100%" height="225">
          <div class="card-body">
            <a href="{{ url('blog-detail') }}"><div class="h5 text-dark">Lorem Ipsum</div></a>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                {{-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> --}}
              </div>
              <small class="text-body-secondary">9 mins</small>
            </div>
          </div>
        </div>
        </a>
      </div>

    </div>
  </div>
  

</section>




@endsection

