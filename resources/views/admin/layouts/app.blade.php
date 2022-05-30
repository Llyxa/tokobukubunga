<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Toko Buku</title>
    <link rel="apple-touch-icon" href="{{asset('assets')}}/admin/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets')}}/admin/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/admin/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/admin/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/admin/vendors/css/extensions/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/admin/vendors/css/forms/wizard/bs-stepper.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/admin/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/admin/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/admin/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/admin/css/colors.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/admin/css/components.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/admin/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/admin/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/admin/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/admin/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/admin/css/pages/dashboard-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/admin/css/plugins/charts/chart-apex.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/admin/css/plugins/extensions/ext-component-toastr.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/admin/css/pages/app-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/admin/css/plugins/forms/pickers/form-pickadate.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/admin/css/plugins/forms/form-wizard.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/admin/css/plugins/forms/form-number-input.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('')}}/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    @include('admin.layouts.navbar')
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    @include('admin.layouts.sidebar')
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    @yield('content')
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    @include('admin.layouts.footer')
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('assets')}}/admin/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('assets')}}/admin/vendors/js/charts/apexcharts.min.js"></script>
    <script src="{{asset('assets')}}/admin/vendors/js/extensions/toastr.min.js"></script>
    <script src="{{asset('assets')}}/admin/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="{{asset('assets')}}/admin/vendors/js/forms/repeater/jquery.repeater.min.js"></script>
    <script src="{{asset('assets')}}/admin/vendors/js/forms/wizard/bs-stepper.min.js"></script>
    <script src="{{asset('assets')}}/admin/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('assets')}}/admin/js/core/app-menu.js"></script>
    <script src="{{asset('assets')}}/admin/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    {{-- <script src="{{asset('assets')}}/admin/js/scripts/pages/dashboard-ecommerce.js"></script> --}}
    <script src="{{asset('assets')}}/admin/js/scripts/forms/form-repeater.js"></script>
    <script src="{{asset('assets')}}/admin/js/scripts/pages/app-ecommerce-checkout.js"></script>
    <!-- END: Page JS-->

    @stack('scripts')
    <script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
    </script>
</body>
<!-- END: Body-->

</html>