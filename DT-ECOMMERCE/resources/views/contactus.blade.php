@extends('layouts.app')
@section('content')
<section class="aboutus-banner mb-5">
    <div class="overlay"></div>
    <div class="container z-2 position-relative">
        <div class="row">
            <div class="col-lg-12 text-center"> <!-- Added text-center class -->
                <h1>CONTACT US</h1>
                {{-- <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p> --}}
                {{-- <a href="#" class="my-btn">shop now!</a> --}}
            </div>
        </div>
    </div>
</section>

<section>
  <div class="container my-5">
    <div class="row">
      <div class="col-md-6">
        <h5>CONTACT US</h5>
        <form>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <input type="text" class="form-control" id="name" placeholder="Your Name" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <input type="email" class="form-control" id="email" placeholder="Your Email" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="mb-3">
                <input type="tel" class="form-control" id="phone" placeholder="Your Phone">
              </div>
            </div>
            <div class="col-md-12">
              <div class="mb-3">
                <textarea class="form-control" id="message" rows="3" required placeholder="Your Message"></textarea>
              </div>
            </div>
          </div>
          <button type="submit" class="my-btn">Send Message</button>
        </form>
      </div>
      <div class="col-md-6">
        <h5>COMPANY INFO</h5>
        <div class="mt-4">
          <h6><strong>Address:</strong> 1234 Street Name, City</h6>
          <br>
          <h6><strong>Email:</strong> contact@company.com</h6>
          <br>
          <h6><strong>Phone:</strong> (555) 123-4567</h6>
          <br>
          <h6><strong>Opening Hours:</strong> 9:00 AM - 5:00 PM, Mon - Fri</h6>
          <br>
          <!-- Social Icons -->
          <div class="social-icons">
            <a href="#" class="me-3"><i class="text-danger fab fa-facebook"></i></a>
            <a href="#" class="me-3"><i class="text-danger fab fa-twitter"></i></a>
            <a href="#" class="me-3"><i class="text-danger fab fa-instagram"></i></a>
            <a href="#" class="me-3"><i class="text-danger fab fa-behance"></i></a>
            <a href="#" class="me-3"><i class="text-danger fab fa-youtube"></i></a>
            <!-- Add more social icons as needed -->
          </div>
        </div>
      </div>
      
    </div>
  </div>
  

</section>




@endsection

