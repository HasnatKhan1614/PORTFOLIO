@extends('layouts.app')
 <style>
 
 #gallery {
  padding-top: 40px;
  @media screen and (min-width: 991px) {
    padding: 60px 30px 0 30px;
  }
}

.img-wrapper {
  position: relative;
  margin-top: 15px;
  img {
    width: 100%;
  }
}

.img-overlay {
  background: rgba(0,0,0,0.7);
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  opacity: 0;
  i {
    color: #fff;
    font-size: 3em;
  }
}

#overlay {
  background: rgba(0,0,0,0.7);
  width: 100%;
  height: 100%;
  position: fixed;
  top: 0;
  left: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 999;
  // Removes blue highlight
  -webkit-user-select: none;
  -moz-user-select: none;    
  -ms-user-select: none; 
  user-select: none; 
  img {
    margin: 0;
    width: 80%;
    height: auto;
    object-fit: contain;
    padding: 5%;
    @media screen and (min-width:768px) {
        width: 60%;
    }
    @media screen and (min-width:1200px) {
        width: 50%;
    }
  }
}

#nextButton,
#prevButton,
#exitButton {
  color: #fff;
  font-size: 2em;
  transition: opacity 0.8s;
  @media screen and (min-width:768px) {
    font-size: 3em;
  }
}

#nextButton:hover,
#prevButton:hover,
#exitButton:hover {
  opacity: 0.7;
}

#exitButton {
  position: absolute;
  top: 15px;
  right: 15px;
}

 
 </style>
@section('content')
    <section class="aboutus-banner mb-5">
        <div class="overlay"></div>
        <div class="container z-2 position-relative">
            <div class="row">
                <div class="col-lg-12 text-center"> <!-- Added text-center class -->
                    <h1>ABOUT US</h1>
                    {{-- <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p> --}}
                    {{-- <a href="#" class="my-btn">shop now!</a> --}}
                </div>
            </div>
        </div>
    </section>

<section class="about-us">
  <div class="container">
    <div class="row align-items-center">
          <div class="col-lg-6">
            <h5>ABOUT LIFTNASIUN</h5>
            <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
            <div class="d-flex box mb-4 align-items-end gap-3">
              <img src="{{env('ASSET_URL')}}/assets/images/about-1.png" alt="" class="img-fluid">
              <div>
                <h6 class="pt-3">AUTO PART STORE</h6>
                <p>Sit porta elementum laoreet phasellus duis nostra augue. Dictumst in porta inceptos maximus convallis</p>
              </div>
            </div>
            <div class="d-flex box align-items-end gap-3">
              <img src="{{env('ASSET_URL')}}/assets/images/about-2.png" alt="" class="img-fluid">
              <div>
                <h6 class="pt-3">AUTO SERVICE</h6>
                <p>Sit porta elementum laoreet phasellus duis nostra augue. Dictumst in porta inceptos maximus convallis</p>
              </div>
            </div>
          </div>
      <div class="col-lg-6 d-flex justify-content-center"> <!-- Updated this line -->
        <img src="{{env('ASSET_URL')}}/assets/images/about-3.png" alt="" class="img-fluid w-50">
      </div>
    </div>
  </div>
</section>

<section class="why-choose">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <img src="{{env('ASSET_URL')}}/assets/images/why-choose.png" alt="" class="img-fluid">
      </div>
      <div class="col-lg-6">
        {{-- <h4 class="mb-3">Our Mission</h4> --}}
        <h5 class="mb-3">Our Mission</h5>
        <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
        <ul>
          <li>Aliquam ac dapibus lacinia dolor pharetra dui</li>
          <li>Sed adipiscing nostra ornare posuere pellentesque nisl egestas curae</li>
          <li>Vestibulum elit turpis letius fames fusce ornare lobortis vivamus</li>
          <li>Nec auctor ad nostra litora mollis integer dui letius efficitur</li>
          <li>Eu erat at laoreet orci lectus maximus bibendum senectus dolor</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section class="why-choose">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        {{-- <h4 class="mb-3">Our Vision</h4> --}}
        <h5 class="mb-3">Our Vision</h5>
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
        <img src="{{env('ASSET_URL')}}/assets/images/cb6d6526b54b69846a83d6e7bf1e3968.jpeg" alt="" class="img-fluid">
      </div>
    </div>
  </div>
</section>

<section class="why-choose">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <img src="{{env('ASSET_URL')}}/assets/images/506879326-1920x1281-1920w.webp" alt="" class="img-fluid">
      </div>
      <div class="col-lg-6">
        {{-- <h4 class="mb-3">Our Goal</h4> --}}
        <h5 class="mb-3">Our Goal</h5>
        <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
        <ul>
          <li>Aliquam ac dapibus lacinia dolor pharetra dui</li>
          <li>Sed adipiscing nostra ornare posuere pellentesque nisl egestas curae</li>
          <li>Vestibulum elit turpis letius fames fusce ornare lobortis vivamus</li>
          <li>Nec auctor ad nostra litora mollis integer dui letius efficitur</li>
          <li>Eu erat at laoreet orci lectus maximus bibendum senectus dolor</li>
        </ul>
      </div>
    </div>
  </div>
</section>



@endsection

@section('script')

<script>

// Gallery image hover
$( ".img-wrapper" ).hover(
  function() {
    $(this).find(".img-overlay").animate({opacity: 1}, 600);
  }, function() {
    $(this).find(".img-overlay").animate({opacity: 0}, 600);
  }
);

// Lightbox
var $overlay = $('<div id="overlay"></div>');
var $image = $("<img>");
var $prevButton = $('<div id="prevButton"><i class="fa fa-chevron-left"></i></div>');
var $nextButton = $('<div id="nextButton"><i class="fa fa-chevron-right"></i></div>');
var $exitButton = $('<div id="exitButton"><i class="fa fa-times"></i></div>');

// Add overlay
$overlay.append($image).prepend($prevButton).append($nextButton).append($exitButton);
$("#gallery").append($overlay);

// Hide overlay on default
$overlay.hide();

// When an image is clicked
$(".img-overlay").click(function(event) {
  // Prevents default behavior
  event.preventDefault();
  // Adds href attribute to variable
  var imageLocation = $(this).prev().attr("href");
  // Add the image src to $image
  $image.attr("src", imageLocation);
  // Fade in the overlay
  $overlay.fadeIn("slow");
});

// When the overlay is clicked
$overlay.click(function() {
  // Fade out the overlay
  $(this).fadeOut("slow");
});

// When next button is clicked
$nextButton.click(function(event) {
  // Hide the current image
  $("#overlay img").hide();
  // Overlay image location
  var $currentImgSrc = $("#overlay img").attr("src");
  // Image with matching location of the overlay image
  var $currentImg = $('#image-gallery img[src="' + $currentImgSrc + '"]');
  // Finds the next image
  var $nextImg = $($currentImg.closest(".image").next().find("img"));
  // All of the images in the gallery
  var $images = $("#image-gallery img");
  // If there is a next image
  if ($nextImg.length > 0) { 
    // Fade in the next image
    $("#overlay img").attr("src", $nextImg.attr("src")).fadeIn(800);
  } else {
    // Otherwise fade in the first image
    $("#overlay img").attr("src", $($images[0]).attr("src")).fadeIn(800);
  }
  // Prevents overlay from being hidden
  event.stopPropagation();
});

// When previous button is clicked
$prevButton.click(function(event) {
  // Hide the current image
  $("#overlay img").hide();
  // Overlay image location
  var $currentImgSrc = $("#overlay img").attr("src");
  // Image with matching location of the overlay image
  var $currentImg = $('#image-gallery img[src="' + $currentImgSrc + '"]');
  // Finds the next image
  var $nextImg = $($currentImg.closest(".image").prev().find("img"));
  // Fade in the next image
  $("#overlay img").attr("src", $nextImg.attr("src")).fadeIn(800);
  // Prevents overlay from being hidden
  event.stopPropagation();
});

// When the exit button is clicked
$exitButton.click(function() {
  // Fade out the overlay
  $("#overlay").fadeOut("slow");
});


</script>

@endsection