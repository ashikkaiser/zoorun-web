<!DOCTYPE html>

<html lang="en" class="light-style" dir="ltr" data-theme="theme-default" data-assets-path="/frest/"
    data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Not Authorized || Opps...</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/frest/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="/frest/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="/frest/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="/frest/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/frest/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/frest/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/frest/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/frest/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="/frest/vendor/libs/typeahead-js/typeahead.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="/frest/vendor/css/pages/page-misc.css" />

</head>

<body>
    <!-- Content -->

    <!-- Not Authorized -->
    <div class="container-xxl container-p-y">
        <div class="misc-wrapper">
            <h1 class="mb-2 mx-2">You are not authorized!</h1>
            <p class="mb-4 mx-2">You don’t have permission to access this page. Go Home!!</p>
            <a href="{{ route('login') }}" class="btn btn-primary">Back to home</a>
            <div class="mt-5">
                <img src="/frest/img/illustrations/girl-hacking-site-light.png" alt="page-misc-error-light" width="450"
                    class="img-fluid" data-app-light-img="illustrations/girl-hacking-site-light.png"
                    data-app-dark-img="illustrations/girl-hacking-site-dark.png" />
            </div>
        </div>
    </div>
    <!-- /Not Authorized -->

    <!-- / Content -->

</body>

</html>
