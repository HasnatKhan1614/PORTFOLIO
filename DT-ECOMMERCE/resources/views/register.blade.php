@extends('layouts.app')
@section('content')



<section>
  <div class="container my-5">
    <div class="row mb-4">
      <div class="col-12 text-black text-center">
        <h5 class="font-monsteret text-danger">REGISTER</h5>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-6"> <!-- Adjusted column width for responsiveness -->
        <form method="POST" action="{{ route('register') }}">
          @csrf
      
          <div class="mb-4">
              <label for="name" class="form-label">Name</label>
              <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required />
              @error('name')
                  <div class="alert alert-danger">{{ $message }}</div>
              @enderror
          </div>
      
          <div class="mb-4">
              <label for="email" class="form-label">Email</label>
              <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required />
              @error('email')
                  <div class="alert alert-danger">{{ $message }}</div>
              @enderror
          </div>
      
          <div class="mb-4">
              <label for="password" class="form-label">Password</label>
              <input type="password" id="password" name="password" class="form-control" required />
              @error('password')
                  <div class="alert alert-danger">{{ $message }}</div>
              @enderror
          </div>
      
          <div class="mb-4">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required />
              @error('password_confirmation')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
          </div>
        
      
          <button type="submit" class="my-btn btn-block mb-4">Sign up</button>
      </form>
      
      
      </div>
    </div>
  </div>
</section>




@endsection

