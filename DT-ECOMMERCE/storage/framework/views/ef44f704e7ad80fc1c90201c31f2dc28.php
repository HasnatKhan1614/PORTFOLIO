<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liftnasium - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/splidejs/4.1.4/css/splide-core.min.css" integrity="sha512-cSogJ0h5p3lhb//GYQRKsQAiwRku2tKOw/Rgvba47vg0+iOFrQ94iQbmAvRPF5+qkF8+gT7XBct233jFg1cBaQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo e(env('ASSET_URL')); ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo e(env('ASSET_URL')); ?>/assets/css/custom.css">
    <link rel="stylesheet" href="<?php echo e(env('ASSET_URL')); ?>/assets/css/gallery.css">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <style>
      /* Custom CSS to position the modal to the right and add animation */
      .modal-dialog.right {
        position: fixed;
        right: -320px; /* Start off the screen */
        top: 0;
        margin: 0;
        height: 100%;
        width: 415px;
        transition: right 0.3s ease; /* Add transition */
      }
      .modal.show .modal-dialog.right {
        right: 0; /* Slide in when modal is shown */
      }
      .modal-content {
        height: 100%;
        overflow-y: auto;
      }
      .modal-body {
        padding: 15px;
      }

      
    /* Target the pagination links and change their font color */
    .pagination a {
        color: #FF2222; /* Your desired font color */
    }

    .product-container {
    max-width: 600px; /* Adjust based on your layout */
    margin: auto;
    }

    .price {
      font-size: 1.25rem; /* Adjust as needed */
      color: #333; /* Adjust as needed */
    }

    .original-price {
      text-decoration: line-through;
      color: #777; /* Adjust as needed */
    }

    .current-price {
      color: red; /* Adjust as needed */
    }

    .quantity-selector {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
    }

    .quantity-selector input {
      text-align: center;
      width: 50px;
      margin: 0 10px;
      border: 1px solid #ced4da;
    }

    .btn-quantity {
      padding: .375rem .75rem;
    }
    .custom-modal-width .modal-dialog {
      max-width: 60%;
    }

      /* Additional CSS */
    .quantity-selector {
      display: flex;
      align-items: center;
    }

    .btn-quantity {
      padding: .375rem .75rem;
    }

    #quantity {
      text-align: center;
    }

    .quick-view-close-btn{
      position: absolute;
      right: 0;
      top: 0;
      width: 40px;
      height: 40px;
      cursor: pointer;
      font-size: 30px;
      z-index: 2;
      background: none;
      border: 0;
    }

    .dropdown-content {
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    padding: 12px 16px;
    z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    </style>
  </head>
  <body>
    <header class="header">
      <div class="container">
        <div class="row align-items-top">
          <div class="col-lg-2 mb-3 mb-lg-0 col-md-3 col-sm-4 col-4 mx-auto text-center">
            <div class="logo mx-auto">
              <a href="<?php echo e(url('/')); ?>">
                <img src="<?php echo e(env('ASSET_URL')); ?>/assets/images/logo.png" alt="" class="img-fluid">
              </a>
            </div>
          </div>
          <div class="col-lg-10">
            <div class="row mb-5 align-items-center">
              <div class="col-lg-7 mb-3 mb-lg-0">
                <div class="top-header">
                  <form id="searchForm" action="<?php echo e(route('search')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input id="searchInput" name="searchQuery" type="search" class="form-control" placeholder="Search by Make, Model, and Year">
                  </form>
                
                </div>
              </div>
              <div class="col-lg-5">
                <div class="d-flex flex-wrap justify-content-end w-100 gap-5 align-items-center">
                  <?php if(Auth::user() && Auth::user()->is_admin == 0): ?>
                  <div class="add-to-cart">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle text-white" style="background-color: black" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li>
                                <form id="logoutForm" action="<?php echo e(route('logout')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="button" class="dropdown-item" id="dashboard">Dashboard</button>
                                    <button type="button" class="dropdown-item" id="logoutBtn">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                  </div>
                  <?php endif; ?>
                
                  <div class="add-to-cart">
                    <button
                    type="button" 
                    data-bs-toggle="modal" 
                    data-bs-target="#shoppingCartModal"
                    data-bs-placement="top" 
                    data-bs-title="Add to Cart" 
                    data-bs-custom-class="custom-tooltip"
                    class="cart-btn"
                    >
                      <i class="fa-solid fa-cart-shopping"></i>
                    </button>
                    <span class="cart-count"></span>
                  </div>
                  <?php if(!Auth::user()): ?>
                      <a href="<?php echo e(url('/login')); ?>" class="my-btn">Login</a>
                  <?php endif; ?>
                  <?php if(!Auth::user()): ?>
                      <a href="<?php echo e(url('/register')); ?>" class="my-btn black">sign up</a>
                  <?php endif; ?>
                  
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-7 mb-4 mb-lg-0">
                <div class="menu-btn d-lg-none w-100 text-end">
                  <button type="button" class="my-btn text-end">
                    <i class="fa-solid fa-bars"></i>
                  </button>
                </div>
                <ul class="menu text-white fw-bold">
                  <li>
                    <a href="<?php echo e(url('/')); ?>" class="<?php echo e(request()->segment(1) == '/' ? 'active' : ''); ?>">Home</a>
                  </li>
                  <li>
                    <a href="<?php echo e(url('/about-us')); ?>">About</a>
                  </li>
                  <li>
                    <a href="<?php echo e(url('/shop')); ?>" class="<?php echo e(request()->segment(1) == 'shop' ? 'active' : ''); ?>">Shop</a>
                  </li>
                  <li>
                    <a href="<?php echo e(url('/gallery')); ?>">Gallery</a>
                  </li>
                  <li>
                    <a href="<?php echo e(url('/blog')); ?>">Blog</a>
                  </li>
                  <li>
                    <a href="<?php echo e(url('/contact-us')); ?>">Contact</a>
                  </li>
                </ul>
              </div>
              <div class="col-lg-5">
                <div class="d-flex flex-wrap gap-3 justify-content-end w-100 text-white align-items-center">
                  <p>
                    <i class="fa-solid fa-phone"></i>
                  </p>
                  <p>Need help?</p>
                  <p class="tel">317-505-0200</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
        <?php echo $__env->yieldContent('content'); ?>
    <!-- Cart Modal -->
    <div class="modal fade" id="shoppingCartModal" tabindex="-1" aria-labelledby="shoppingCartModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-dialog-scrollable right">
        <div class="modal-content">
          <div class="modal-header">
            <p class="modal-title" id="shoppingCartModalLabel">Shopping Cart</p>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="closest-input-quantity cart-modal-content">
            </div>
            <!-- Shopping Cart Items -->
            <!-- Cart Buttons -->
            <div class="d-flex justify-content-center gap-2 mt-5">
              <a href="<?php echo e(url('/cart')); ?>" class="btn btn-dark">View Cart</a>
              <a href="<?php echo e(url('/checkout')); ?>" class="my-btn btn btn-primary">Checkout</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <footer>
      <div class="footer-top position-relative">
        <div class="overlay-1"></div>
        
        <div class="footer-middle z-2 position-relative">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <div class="logo mb-3">
                  <img src="<?php echo e(env('ASSET_URL')); ?>/assets/images/logo.png" alt="Logo" class="img-fluid">
                </div>
                <div class="d-flex justify-content-center gap-2 align-items-center">
                  <a href="#">
                    <img src="<?php echo e(env('ASSET_URL')); ?>/assets/images/Img.png" alt="" class="img-fluid">
                  </a>
                  <a href="#">
                    <img src="<?php echo e(env('ASSET_URL')); ?>/assets/images/Img-1.png" alt="" class="img-fluid">
                  </a>
                  <a href="#">
                    <img src="<?php echo e(env('ASSET_URL')); ?>/assets/images/Img-2.png" alt="" class="img-fluid">
                  </a>
                  <a href="#">
                    <img src="<?php echo e(env('ASSET_URL')); ?>/assets/images/Img-3.png" alt="" class="img-fluid">
                  </a>
                  <a href="#">
                    <img src="<?php echo e(env('ASSET_URL')); ?>/assets/images/Img-4.png" alt="" class="img-fluid">
                  </a>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <h5>Customer Service</h5>
                <ul class="list-unstyled">
                  <li>
                    <a href="#">My Account</a>
                  </li>
                  <li>
                    <a href="#">Help Center</a>
                  </li>
                  <li>
                    <a href="#">Track My Order</a>
                  </li>
                  <li>
                    <a href="#">Shipping & Returns</a>
                  </li>
                  <li>
                    <a href="#">Store Location</a>
                  </li>
                </ul>
              </div>
              <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <h5>Information</h5>
                <ul class="list-unstyled">
                  <li>
                    <a href="#">About</a>
                  </li>
                  <li>
                    <a href="#">Legal Notice</a>
                  </li>
                  <li>
                    <a href="#">Customer Reviews</a>
                  </li>
                  <li>
                    <a href="#">Guides & Articles</a>
                  </li>
                  <li>
                    <a href="#">Coupon Codes</a>
                  </li>
                </ul>
              </div>
              <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <h5>Information</h5>
                <div class="d-flex align-items-center mb-3 gap-2">
                  <i class="fas fa-location-dot"></i>
                  <p>1202 N Shadeland Ave, Indianapolis, IN 46219</p>
                </div>
                <div class="d-flex align-items-center mb-3 gap-2">
                  <i class="fa-regular fa-envelope"></i>
                  <p>example@gmail.com</p>
                </div>
                <div class="d-flex align-items-center mb-3 gap-2">
                  <i class="fa-solid fa-phone"></i>
                  <p>317-505-0200</p>
                </div>
                <div class="d-flex align-items-center mb-3 gap-2">
                  <i class="fa-regular fa-clock"></i>
                  <p>Fri 09:00 AM to 05:00 PM EST</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <p class="mb-0">© 2023 All Rights Reserved.</p>
            </div>
            <div class="col-lg-6">
              <ul class="list-unstyled d-flex justify-content-end mb-0">
                <li>
                  <a href="#">All Products</a>
                </li>
                <li>
                  <a href="#">Brands</a>
                </li>
                <li>
                  <a href="#">Special Offers</a>
                </li>
                <li>
                  <a href="#">About</a>
                </li>
                <li>
                  <a href="#">Contact</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/splidejs/4.1.4/js/splide.min.js" integrity="sha512-4TcjHXQMLM7Y6eqfiasrsnRCc8D/unDeY1UGKGgfwyLUCTsHYMxF7/UHayjItKQKIoP6TTQ6AMamb9w2GMAvNg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> 
    <script>
      $('.menu-btn').on('click', function() {
        $('.menu').slideToggle();
      });
      const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
      const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
      var splide = new Splide('.companies-splide', {
        type: 'loop',
        perPage: 4,
        pauseOnHover: false,
        arrows: true,
        pagination: true,
        autoplay: true,
        gap: '0rem',
        perMove: 1,
        interval: 2000,
        speed: 1000,
        classes: {
          prev: 'splide__arrow--prev fa-solid fa-chevron-left',
          next: 'splide__arrow--next fa-solid fa-chevron-right',
        },
        breakpoints: {
          991: {
            perPage: 3
          },
          756: {
            perPage: 2,
            gap: '1rem'
          },
          556: {
            perPage: 1,
          },
        },
      });
      splide.mount();
      var splide_3 = new Splide('.testimonial-splide', {
        // type: 'loop',
        rewind: true,
        perPage: 2,
        pauseOnHover: true,
        arrows: false,
        pagination: true,
        autoplay: true,
        gap: '1.2rem',
        breakpoints: {
          560: {
            perPage: 1
          },
        },
      });
      splide_3.mount();
    </script>

<?php if(session()->has('success')): ?>
    <script>
        toastr.success('<?php echo e(session('success')); ?>');
    </script>
<?php endif; ?>
<?php if(session()->has('error')): ?>
    <script>
        toastr.error('<?php echo e(session('error')); ?>');
    </script>
<?php endif; ?>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
          // Select all elements with the specified classes
          const decrementButtons = document.querySelectorAll('.decrement');
          const incrementButtons = document.querySelectorAll('.increment');
          const numberDisplays = document.querySelectorAll('.number');

          // Add event listeners for decrement buttons
          decrementButtons.forEach(function(button) {
              button.addEventListener('click', function() {
                  let index = Array.from(decrementButtons).indexOf(button);
                  let currentValue = parseInt(numberDisplays[index].textContent);
                  if (currentValue > 1) {
                      currentValue--;
                      numberDisplays[index].textContent = currentValue;
                  }
              });
          });

          // Add event listeners for increment buttons
          incrementButtons.forEach(function(button) {
              button.addEventListener('click', function() {
                  let index = Array.from(incrementButtons).indexOf(button);
                  let currentValue = parseInt(numberDisplays[index].textContent);
                  currentValue++;
                  numberDisplays[index].textContent = currentValue;
              });
          });
      });
    </script>

    <script>
      // Define cart globally
      var cart = [];
      $(document).ready(function() {
        updateCartCount();
        // Function to save cart to localStorage
        function saveCart() {
          localStorage.setItem('shoppingCart', JSON.stringify(cart));
        }

        // Function to load cart from localStorage
        function loadCart() {
          var storedCart = localStorage.getItem('shoppingCart');
          if (storedCart) {
            cart = JSON.parse(storedCart);
          } else {
            // Reset cart to an empty array if localStorage is empty
            cart = [];
          }
          updateCartModal();
          updateCartView();
        }

        loadCart();

        function updateCartModal() {
          var subtotal = 0;
          var cartHtml = '';

          if (cart.length === 0) {
            $('.cart-modal-content').html('<tr><td colspan="4">Your cart is empty</td></tr>');
            return; // Exit the function early
          }

          cart.forEach(function(item) {
            // Ensure the item has a price and quantity and that both are numbers
            if (item.price && item.quantity && !isNaN(item.price) && !isNaN(item.quantity)) {
              subtotal += item.price * item.quantity;
              cartHtml += `
                <div class="d-flex justify-content-between align-items-center mb-3 border-bottom">
                  <div class="d-flex align-items-center">
                    <img src="${item.image}" alt="${item.name}" style="width: 60px; height: auto;">
                    <div class="ms-3">
                      <h6 class="mb-0">${item.name}</h6>
                      <small>${item.quantity} x $${item.price.toFixed(2)}</small>
                    </div>
                  </div>
                  <button type="button" class="btn-close" aria-label="Remove" onclick="removeFromCart('${item.id}')"></button>
                </div>
              `;
            } else {
              console.error('Item price or quantity is not valid:', item);
            }
          });
          $('.cart-modal-content').html(cartHtml);
          $('.cart-modal-content').append(`<p class="text-end">Total: $${subtotal.toFixed(2)}</p>`);
        }

        // Function to update the cart view
        function updateCartView() {
          var subtotal = 0;
          var cartHtml = '';
          
          // Check if the cart is empty
          if (cart.length === 0) {
            $('.cart-items').html('<tr><td colspan="4">Your cart is empty</td></tr>');
            $('.go-to').html('<a href="<?php echo url('/shop'); ?>" class="my-btn update-cart">Go to Shop</a>');
            return; // Exit the function early
          }
          $('.go-to').html('<a href="<?php echo url('/checkout'); ?>" class="my-btn update-cart">Checkout</a>');

          cart.forEach(function(item) {
            // Ensure the item has a price and quantity and that both are numbers
            if (item.price && item.quantity && !isNaN(item.price) && !isNaN(item.quantity)) {
              var itemSubtotal = item.price * item.quantity;
              subtotal += itemSubtotal;
              cartHtml += `
                  <tr>
                    <td>
                      <button type="button" class="btn text-danger" aria-label="Remove" onclick="removeFromCart('${item.id}')" style="font-size: 21px;padding: 0;margin: 0;font-weight: 700;">X</button>
                      <img src="https://media.wheelpros.com/m/b7d22077f2d504ac/original/mercedes-wheels-rims-mandrus-23-5-lug-both-matte-black-std-org-png.png" alt="${item.name}" style="width: 50px;">
                      <span>${item.name}</span>
                    </td>
                    <td>$${item.price}</td>
                    <td>
                      <input type="number" class="form-control quantity-input" value="${item.quantity}" data-item-id="${item.id.toString()}">
                    </td>
                    <td class="item-subtotal">$${itemSubtotal.toFixed(2)}</td>
                  </tr>
              `;
            } else {
              console.error('Item price or quantity is not valid:', item);
            }
          });

          // Append the cart items HTML to the table body
          $('.cart-items').html(cartHtml);
          
          // Update the total and append it below the subtotal
          var totalHtml = `<tr><td colspan="3" class="text-end">Subtotal:</td><td class="subtotal">$${subtotal.toFixed(2)}</td></tr>`;
          totalHtml += `<tr><td colspan="3" class="text-end">Total:</td><td class="total">$${subtotal.toFixed(2)}</td></tr>`;
          $('.cart-items').append(totalHtml);
        }

        updateCartView();

        // Add to Cart button click handler
        $('.add-to-cart').on('click', function(event) {
          event.preventDefault();

          var price = $(this).data('price');

          if (isNaN(price)) {
            return;
          }

          price = parseFloat(price);

          var id = $(this).data('id'); // Assuming each product has a unique `data-id`
          var name = $(this).data('name');
          var image = $(this).data('image');
          var vendor = $(this).data('vendor');
          
          // Get the quantity value for the specific product
          var quantityInput = $(this).closest('.closest-input-quantity').find('.quantity-input');
          var quantity = parseInt(quantityInput.text());
          if (isNaN(quantity)) {
            quantity = 1; // Set quantity to 1 if it's not a number or not found
          }

          // Check if item is already in the cart
          var existingItem = cart.find(item => item.id === id);
          if (existingItem) {
            existingItem.quantity += quantity; // Add quantity
          } else {
            // Add new item to the cart
            cart.push({ id, name, price, image, vendor, quantity });
          }

          saveCart(); // Save the cart to localStorage
          updateCartModal(); // Update the modal content
          updateCartCount();
        });




        // Function to update subtotal and total when quantity changes
        $(document).on('change', '.quantity-input', function() {
          var itemId = $(this).data('item-id');
          var newQuantity = parseInt($(this).val());
          var item = cart.find(function(item) {
            return item.id === itemId;
          });
          if (item) {
            if (newQuantity > 0) { // Check if the new quantity is greater than 0
              item.quantity = newQuantity;
              updateCartView();
              saveCart(); // Save the updated cart to localStorage
              updateCartCount(); // Update the cart count
            } else {
              // Reset the quantity input value to 1 if the new quantity is 0
              $(this).val(1);
            }
          }
        });


        function updateCartCount() {

            var cart = JSON.parse(localStorage.getItem('shoppingCart')) || [];

            var totalQuantity = cart.reduce(function(sum, item) {
                return sum + item.quantity;
            }, 0);

            $('.cart-count').text(totalQuantity);
        }
        
        window.removeFromCart = function(id) {
            // Ensure id is treated as a string to handle both string and number types
            var idString = id.toString();

            cart = cart.filter(function(item) {
                // Also convert item.id to a string for a proper comparison
                return item.id.toString() !== idString;
            });
            
            saveCart(); // Save the updated cart to localStorage
            updateCartModal(); // Update the modal content
            updateCartView(); // Update the modal content
            updateCartCount();
          };
        });

    </script>


<script>
  $(document).ready(function() {
      $('#logoutBtn').click(function() {
          // Fetch CSRF token
          var csrfToken = $('meta[name="csrf-token"]').attr('content');

          $.ajax({
              url: $('#logoutForm').attr('action'),
              type: 'POST',
              data: $('#logoutForm').serialize(),
              headers: {
                  'X-CSRF-TOKEN': csrfToken // Add CSRF token to headers
              },
              success: function(response) {
                  // Handle successful logout response
                  toastr.success('Logout successful');
                  
                  // Reload the page after a delay
                  setTimeout(function() {
                      window.location.reload();
                  }, 1000);
              },
              error: function(xhr, status, error) {
                toastr.error('error');
              }
          });
      });
  });

  $(document).ready(function() {
      $('#dashboard').click(function() {
          window.location = '/user/dashboard'
      });
  });
</script>

<script>
  $(document).ready(function() {
      // Listen for Enter key press on the input field
      $('#searchInput').keypress(function(event) {
          // Check if Enter key is pressed (key code 13)
          if (event.which === 13) {
              // Submit the form
              $('#searchForm').submit();
          }
      });
  });
</script>

<script>
  //submit image
  function submitForm(category) {
      var form = document.getElementById("categoryForm");
      var input = document.createElement("input");
      input.type = "hidden";
      input.name = "categories[]";
      input.value = category;
      form.appendChild(input);
      form.submit();
  }
</script>
<script>
  //show more
  $(document).ready(function () {
      $('#showMoreBtn').click(function () {
          $('.list-group-item').removeClass('d-none');
          $('#showMoreBtn').addClass('d-none');
          $('#showLessBtn').removeClass('d-none');
      });

      $('#showLessBtn').click(function () {
          $('.list-group-item:gt(9)').addClass('d-none');
          $('#showMoreBtn').removeClass('d-none');
          $('#showLessBtn').addClass('d-none');
      });
  });
</script>

    <?php echo $__env->yieldContent('script'); ?>
  </body>
</html><?php /**PATH C:\Users\Hasnat Khan\Desktop\Diligenttek\liftnasium\resources\views/layouts/app.blade.php ENDPATH**/ ?>