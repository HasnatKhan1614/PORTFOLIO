@extends('layouts.app')
@section('content')

<section>

<div class="container mt-5">
    <form id="orderForm" method="POST">
        @csrf
        <div class="row">

            <div class="col-md-7">
                <h4>BILLING DETAILS</h4>
            
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" name="first_name" class="form-control" placeholder="First name *" required>
                    </div>
                    <div class="col">
                        <input type="text" name="last_name" class="form-control" placeholder="Last name *" required>
                    </div>
                </div>
                <div class="mb-3">
                    <input type="text" name="company_name" class="form-control" placeholder="Company name (optional)">
                </div>
                <div class="mb-3">
                    <select name="country" class="form-select" required>
                        <option selected>United States (US)</option>
                        <!-- Add other options here -->
                    </select>
                </div>
                <div class="mb-3">
                    <input type="text" name="street_address" class="form-control" placeholder="Street address *" required>
                </div>
                <div class="mb-3">
                    <input type="text" name="apartment" class="form-control" placeholder="Apartment, suite, unit, etc. (optional)">
                </div>
                <div class="mb-3">
                    <input type="text" name="city" class="form-control" placeholder="Town / City *" required>
                </div>
                <div class="mb-3">
                    <select name="state" class="form-select" required>
                        <option selected>California</option>
                        <!-- Add other states here -->
                    </select>
                </div>
                <div class="mb-3">
                    <input type="text" name="zip_code" class="form-control" placeholder="ZIP Code *" required>
                </div>
                <div class="mb-3">
                    <input type="tel" name="phone" class="form-control" placeholder="Phone *" required>
                </div>
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email address *" required>
                </div>
            
                <h4>ADDITIONAL INFORMATION</h4>
                <div class="mb-3">
                    <textarea name="order_notes" class="form-control" placeholder="Order notes (optional)" rows="4"></textarea>
                </div>
            
            </div>
            
            

            <div class="col-md-5">
                <h4>YOUR ORDER</h4>
                <table class="table" id="order-summary">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="order-items">
                        <!-- Dynamic rows will be inserted here -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="row">Subtotal</th>
                            <td></td>
                            <td id="order-subtotal">$0.00</td>
                        </tr>
                        <tr>
                            <th scope="row">Total</th>
                            <td></td>
                            <td id="order-total">$0.00</td>
                        </tr>
                    </tfoot>
                </table>
                    <div class="p-3">
                        <h4 class="d-flex justify-content-center">PAY WITH CARD OR AFFIRM</h4>
            
                            {{-- <input type='hidden' name='stripeToken' id='stripe-token-id'>                               --}}
                            <input type='hidden' name='subtotal' id='subtotal'>     

                            <br>
                            {{-- <div id="card-element" class="form-control"></div> --}}
                            
                            <button 
                                id='pay-btn'
                                class="my-btn mt-3"
                                type="submit"
                                style="margin-top: 20px; width: 100%; padding: 7px;"
                                onclick="createToken()">PAY <span id="pay-amount">$0</span>
                            </button>
                    </div>
            </div>
        </div>
    </form>
</div>

</section>



@endsection

@section('script')
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
  
    // var stripe = Stripe('{{ env('STRIPE_KEY') }}')
    // var elements = stripe.elements();
    // var cardElement = elements.create('card');
    // cardElement.mount('#card-element');
  
    /*------------------------------------------
    --------------------------------------------
    Create Token Code
    --------------------------------------------
    --------------------------------------------*/
    function createToken() {
        // document.getElementById("pay-btn").disabled = true;
        // stripe.createToken(cardElement).then(function(result) {
   
            // if(typeof result.error != 'undefined') {
            //     document.getElementById("pay-btn").disabled = false;
            //     toastr.error(result.error.message);
            // }
            // document.getElementById("pay-btn").disabled = false;
  
            /* creating token success */
            // if(typeof result.token != 'undefined') {
            //     document.getElementById("stripe-token-id").value = result.token.id;

                // Parse the serialized data to get individual field values
                var firstName = $('#orderForm input[name="first_name"]').val();
                var lastName = $('#orderForm input[name="last_name"]').val();
                var companyName = $('#orderForm input[name="company_name"]').val();
                var country = $('#orderForm select[name="country"]').val();
                var streetAddress = $('#orderForm input[name="street_address"]').val();
                var apartment = $('#orderForm input[name="apartment"]').val();
                var city = $('#orderForm input[name="city"]').val();
                var state = $('#orderForm select[name="state"]').val();
                var zipCode = $('#orderForm input[name="zip_code"]').val();
                var phone = $('#orderForm input[name="phone"]').val();
                var email = $('#orderForm input[name="email"]').val();
                var orderNotes = $('#orderForm textarea[name="order_notes"]').val();

                var subtotal = $('#orderForm input[name="subtotal"]').val();
                var cartItems = JSON.parse(localStorage.getItem('shoppingCart')) || [];

                // console.log(stripeToken);

                // Send an AJAX request
                $.ajax({
                    type: 'POST',
                    url: '{{ route("order.store") }}',
                    data: {
                        _token: "{{ csrf_token() }}",
                        first_name: firstName,
                        last_name: lastName,
                        company_name: companyName,
                        country: country,
                        street_address: streetAddress,
                        apartment: apartment,
                        city: city,
                        state: state,
                        zip_code: zipCode,
                        phone: phone,
                        email: email,
                        order_notes: orderNotes,
                        subtotal: subtotal,
                        // stripeToken: stripeToken,
                        cartItems: cartItems
                    },
                    success: function(response) {
                        // Extract the orderId from the response
                        var orderId = response.orderID;

                        // Show a success message using Toastr
                        toastr.success('Redirecting to Checkout.....');

                        localStorage.removeItem('shoppingCart');

                        // Redirect the user to the thank you page after 3 seconds
                        setTimeout(function() {
                            window.location.href = response.paymentLink;
                        }, 3000); // 3000 milliseconds = 3 seconds
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        toastr.error(xhr.responseText);
                    }
                });




            // }
        // });
    }
</script>

<script>
    $(document).ready(function() {
        $('#orderForm').submit(function(e) {
            e.preventDefault(); // Prevent the form from submitting normally
            
            // Parse the serialized data to get individual field values
            // var firstName = $('#orderForm input[name="first_name"]').val();
            // var lastName = $('#orderForm input[name="last_name"]').val();
            // var companyName = $('#orderForm input[name="company_name"]').val();
            // var country = $('#orderForm select[name="country"]').val();
            // var streetAddress = $('#orderForm input[name="street_address"]').val();
            // var apartment = $('#orderForm input[name="apartment"]').val();
            // var city = $('#orderForm input[name="city"]').val();
            // var state = $('#orderForm select[name="state"]').val();
            // var zipCode = $('#orderForm input[name="zip_code"]').val();
            // var phone = $('#orderForm input[name="phone"]').val();
            // var email = $('#orderForm input[name="email"]').val();
            // var orderNotes = $('#orderForm textarea[name="order_notes"]').val();

            // var subtotal = $('#orderForm input[name="subtotal"]').val();
            // var stripeToken = $('#stripe-token-id').val();
            // var cartItems = JSON.parse(localStorage.getItem('shoppingCart')) || [];

            // console.log(stripeToken)

            // Send an AJAX request
            // $.ajax({
            //     type: 'POST',
            //     url: '{{ route("order.store") }}',
            //     data: {
            //         _token: "{{ csrf_token() }}",
            //         first_name: firstName,
            //         last_name: lastName,
            //         company_name: companyName,
            //         country: country,
            //         street_address: streetAddress,
            //         apartment: apartment,
            //         city: city,
            //         state: state,
            //         zip_code: zipCode,
            //         phone: phone,
            //         email: email,
            //         order_notes: orderNotes,
            //         subtotal: subtotal,
            //         stripeToken: stripeToken
            //         cartItems: cartItems,
            //     },
            //     success: function(response) {
            //         // Handle the success response
            //         toastr.success(response.success);
            //         // You can redirect the user or show a success message
            //     },
            //     error: function(xhr, status, error) {
            //         // Handle errors
            //         toastr.error(xhr.responseText);
            //     }
            // });
        });
    });
</script>

{{-- <script>

    // Function to handle payment
    function payWithStripe() {
        // Retrieve the subtotal from the hidden input
        var subtotal = $('#subtotal').val();

        // Make an AJAX request to the server to handle payment
        $.ajax({
            url: "{{ route('stripe.post') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                stripeToken: $('#stripe-token-id').val(),
                subtotal: subtotal
            },
            success: function(response) {
                // Handle success response from the server
                toastr.success(response.success);
                // For example, you can redirect the user to a success page
            },
            error: function(xhr, status, error) {
                // Handle error response from the server
                toastr.error(xhr.responseJSON.error);
            }
        });
    }

</script> --}}

<script>
    $(document).ready(function() {
      // Function to retrieve cart items from localStorage and update order summary
      function updateOrderSummary() {
          var cartItems = JSON.parse(localStorage.getItem('shoppingCart')) || [];
          var orderItemsHtml = '';
          var subtotal = 0;
          var productSkus = '';
  
          // Iterate over cart items to generate rows for order summary
          cartItems.forEach(function(item) {
              orderItemsHtml += `
              <tr>
                  <td>${item.name}</td>
                  <td>${item.quantity}</td>
                  <td>$${(item.price * item.quantity).toFixed(2)}</td>
              </tr>
              `;
              subtotal += item.price * item.quantity;
  
              // Concatenate SKUs
              productSkus += item.sku + ', ';
          });
  
          // Remove the trailing comma and space
          productSkus = productSkus.replace(/,\s*$/, '');
  
          // Update order items in the table
          $('#order-items').html(orderItemsHtml);
          // Update subtotal and total in the table footer
          $('#order-subtotal').text(`$${subtotal.toFixed(2)}`);
          $('#order-total').text(`$${subtotal.toFixed(2)}`);
          // Update subtotal in the hidden input field
          $('#subtotal').val(subtotal.toFixed(2));
          // Update product SKUs in the hidden input field
  
          // Update subtotal and total in the button text
          $('#pay-amount').text(`$${subtotal.toFixed(2)}`);
      }
  
  
      // Call the function to update order summary when the page loads
      updateOrderSummary();
    });
  </script>



@endsection