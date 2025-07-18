

<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Liftnasium Dashboard</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo e(env('ASSET_URL')); ?>/assets/images/logo.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="<?php echo e(env('ASSET_URL')); ?>/dashboard/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?php echo e(env('ASSET_URL')); ?>/dashboard/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?php echo e(env('ASSET_URL')); ?>/dashboard/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?php echo e(env('ASSET_URL')); ?>/dashboard/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?php echo e(env('ASSET_URL')); ?>/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="<?php echo e(env('ASSET_URL')); ?>/dashboard/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- toastr -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="<?php echo e(env('ASSET_URL')); ?>/dashboard/assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?php echo e(env('ASSET_URL')); ?>/dashboard/assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="<?php echo e(url('/user/dashboard')); ?>" class="app-brand-link">
              <span class="app-brand-logo demo">
                
                
              </span>
              <span class="app-brand-text demo menu-text fw-bold ms-2">Liftnasium</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <li class="menu-item">
              <a
                href="<?php echo e(url('/user/dashboard')); ?>"
                class="menu-link">
                
                <div>Dashboard</div>
              </a>
            </li>
            <li class="menu-item">
              <a
                href="<?php echo e(url('/user/gallery')); ?>"
                class="menu-link">
                
                <div>Gallery</div>
              </a>
            </li>
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="<?php echo e(env('ASSET_URL')); ?>/dashboard/assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="<?php echo e(env('ASSET_URL')); ?>/dashboard/assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-medium d-block"><?php echo e(Auth::user()->name); ?></span>
                            <small class="text-muted">User</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <form id="logoutForm" action="<?php echo e(route('logout')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="button" class="dropdown-item" id="dashboard">Dashboard</button>
                        <button type="button" class="dropdown-item" id="logoutBtn">Logout</button>
                      </form>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <?php echo $__env->yieldContent('content'); ?>
            </div>
            <!-- / Content -->


            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="<?php echo e(env('ASSET_URL')); ?>/dashboard/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?php echo e(env('ASSET_URL')); ?>/dashboard/assets/vendor/libs/popper/popper.js"></script>
    <script src="<?php echo e(env('ASSET_URL')); ?>/dashboard/assets/vendor/js/bootstrap.js"></script>
    <script src="<?php echo e(env('ASSET_URL')); ?>/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?php echo e(env('ASSET_URL')); ?>/dashboard/assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?php echo e(env('ASSET_URL')); ?>/dashboard/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="<?php echo e(env('ASSET_URL')); ?>/dashboard/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="<?php echo e(env('ASSET_URL')); ?>/dashboard/assets/js/dashboards-analytics.js"></script>

    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <?php echo $__env->yieldContent('script'); ?>

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

  </body>
</html>
<?php /**PATH E:\project\liftnasium\app\resources\views/user/layouts/app.blade.php ENDPATH**/ ?>