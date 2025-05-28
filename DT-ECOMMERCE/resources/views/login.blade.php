@extends('layouts.app')
@section('content')



<section>
  <div class="container my-5">
    <div class="row mb-4">
      <div class="col-12 text-black text-center">
        <h5 class="font-monsteret text-danger">LOGIN</h5>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-6"> <!-- Adjusted column width for responsiveness -->
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <!-- Email input -->
          <div class="mb-4">
              <label for="email" class="form-label">Email address</label>
              <input type="email" id="email" name="email" class="form-control" required />
          </div>
      
          <!-- Password input -->
          <div class="mb-4">
              <label for="password" class="form-label">Password</label>
              <input type="password" id="password" name="password" class="form-control" required />
          </div>
      
          <!-- 2 column grid layout for inline styling -->
          <div class="row mb-4">
              <div class="col d-flex align-items-center">
                  <!-- Other content can go here -->
              </div>
          </div>
      
          <!-- Submit button -->
          <button type="submit" class="my-btn btn-block mb-4">Sign in</button>
      
          <!-- Other buttons or links -->
          <!-- Uncomment and modify as needed -->
      </form>
      
      </div>
    </div>
  </div>
</section>




@endsection

