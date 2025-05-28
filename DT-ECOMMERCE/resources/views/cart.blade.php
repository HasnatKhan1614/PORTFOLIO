@extends('layouts.app')
<style>
  .remove-btn {
    color: #dc3545;
    cursor: pointer;
    margin-right: 10px; /* Added margin for spacing */
  }
  .table {
    margin-bottom: 0;
  }
  .apply-coupon {
    width: auto; /* Changed from 100% to auto */
    margin-right: 8px;
  }
  .update-cart {
    width: auto; /* Changed from 100% to auto */
    float: right;
  }
  .container, .container-fluid, .container-sm, .container-md, .container-lg, .container-xl, .container-xxl {
    padding-right: 15px;
    padding-left: 15px; /* Adjust container padding */
  }
</style>
@section('content')

<section>
    <div class="container my-5"> <!-- Moved container out of the row -->
        <table class="table">
        <thead>
            <tr>
            <th scope="col">PRODUCT</th>
            <th scope="col">PRICE</th>
            <th scope="col">QUANTITY</th>
            <th scope="col">SUBTOTAL</th>
            </tr>
        </thead>
        <tbody class="cart-items">
            
        </tbody>
        </table>
        <div class="row">
            {{-- <div class="col-12 col-md-6"> <!-- Added responsiveness -->
                <div class="input-group my-3">
                    <input type="text" class="form-control apply-coupon" placeholder="Coupon code">
                    <button class="btn btn-outline-primary" type="button">APPLY COUPON</button>
                </div>
            </div> --}}
            <div class="col-12 col-md-6 go-to"> <!-- Added responsiveness -->
                
            </div>
        </div>
    </div>
</section>



@endsection

@section('script')
<script>

</script>
@endsection