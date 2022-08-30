<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="/frest/" data-template="vertical-menu-template-starter">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Courier</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/frest/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="/frest/vendor/fonts/boxicons.css" />

    <link rel="stylesheet" href="/frest/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/frest/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/frest/css/demo.css" />

    <link rel="stylesheet" href="/frest/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('frest/vendor/libs/sweetalert2/sweetalert2.css') }}" />

    <script src="/frest/vendor/js/helpers.js"></script>

    <script src="/frest/vendor/js/template-customizer.js"></script>
    <script src="/frest/js/config.js"></script>

    @yield('css')

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            @include('themes.frest.partials.warehousePanel.aside')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                @include('themes.frest.partials.nav')

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>
                    <!-- / Content -->
                    @include('themes.frest.partials.footer')

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="/frest/vendor/libs/jquery/jquery.js"></script>
    <script src="/frest/vendor/libs/popper/popper.js"></script>
    <script src="/frest/vendor/js/bootstrap.js"></script>
    <script src="/frest/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{ asset('frest/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('frest/js/extended-ui-sweetalert2.js') }}"></script>

    <script src="/frest/vendor/libs/hammer/hammer.js"></script>

    <script src="/frest/vendor/js/menu.js"></script>


    <!-- endbuild -->

    <!-- Vendors JS -->
    @yield('js')
    <!-- Main JS -->
    <script src="/frest/js/main.js"></script>
    <script>
        var select2 = $('.select2');
        if (select2.length) {
            select2.each(function() {
                var $this = $(this);
                $this.wrap('<div class="position-relative"></div>').select2({
                    placeholder: 'Select value',
                    dropdownParent: $this.parent()
                });
            });
        }
    </script>
    @yield('inline-js')

    <!-- Page JS -->
</body>

</html>
