<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <link href="{{env('ASSET_URL')}}/css/app.css" rel="stylesheet" />

            <!-- GOOGLE FONTS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800;900&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet"> 

        <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />

        <!-- PLUGINS CSS STYLE -->
        <link href="{{env('ASSET_URL')}}/assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet">
        <link href="{{env('ASSET_URL')}}/assets/plugins/simplebar/simplebar.css" rel="stylesheet" />

        <!-- Ekka CSS -->
        <link id="ekka-css" href="{{env('ASSET_URL')}}/assets/css/ekka.css" rel="stylesheet" />

        <!-- FAVICON -->
        <link href="{{env('ASSET_URL')}}/assets/img/favicon.png" rel="shortcut icon" />

        <style>
            .edit-icon{
                font-size: 30px;
                padding: 5px;
            }
            .delete-icon{
                font-size: 30px;
                padding: 5px;
            }
            .search-icon{
                font-size: 30px;
                padding: 5px;
            }
        </style>

            <!-- Common Javascript -->
        <script src="{{env('ASSET_URL')}}/assets/plugins/jquery/jquery-3.5.1.min.js"></script>
        <script src="{{env('ASSET_URL')}}/assets/js/bootstrap.bundle.min.js"></script>
        <script src="{{env('ASSET_URL')}}/assets/plugins/simplebar/simplebar.min.js"></script>
        <script src="{{env('ASSET_URL')}}/assets/plugins/jquery-zoom/jquery.zoom.min.js"></script>
        <script src="{{env('ASSET_URL')}}/assets/plugins/slick/slick.min.js"></script>

        <!-- Chart -->
        <script src="{{env('ASSET_URL')}}/assets/plugins/charts/Chart.min.js"></script>
        <script src="{{env('ASSET_URL')}}/assets/js/chart.js"></script>

        <!-- Google map chart -->
        <script src="{{env('ASSET_URL')}}/assets/plugins/charts/google-map-loader.js"></script>
        <script src="{{env('ASSET_URL')}}/assets/plugins/charts/google-map.js"></script>

        <!-- Date Range Picker -->
        <script src="{{env('ASSET_URL')}}/assets/plugins/daterangepicker/moment.min.js"></script>
        <script src="{{env('ASSET_URL')}}/assets/plugins/daterangepicker/daterangepicker.js"></script>
        <script src="{{env('ASSET_URL')}}/assets/js/date-range.js"></script>

        <!-- Data Tables -->
        <link href='{{env('ASSET_URL')}}/assets/plugins/data-tables/datatables.bootstrap5.min.css')}}' rel='stylesheet'>
        <link href='{{env('ASSET_URL')}}/assets/plugins/data-tables/responsive.datatables.min.css')}}' rel='stylesheet'>

        <!-- Option Switcher -->
        <script src="{{env('ASSET_URL')}}/assets/plugins/options-sidebar/optionswitcher.js"></script>

        
	    <!-- Data Tables -->
        <script src='{{env('ASSET_URL')}}/assets/plugins/data-tables/jquery.datatables.min.js')}}'></script>
        <script src='{{env('ASSET_URL')}}/assets/plugins/data-tables/datatables.bootstrap5.min.js')}}'></script>
        <script src='{{env('ASSET_URL')}}/assets/plugins/data-tables/datatables.responsive.min.js')}}'></script>

        <!-- Ekka Custom -->
        <script src="{{env('ASSET_URL')}}/assets/js/ekka.js"></script>
        <script src="{{env('ASSET_URL')}}/js/app.js" defer></script>
        @inertiaHead
    </head>
    <body class="ec-header-fixed ec-sidebar-fixed ec-sidebar-light ec-header-light sidebar-minified-out" id="body">
        @inertia
    </body>

</html>