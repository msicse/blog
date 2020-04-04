<head>
    <title>Blog | @yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">


    <!-- Font -->

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">


    <!-- Stylesheets -->

    <link href="{{ asset('frontend/css/bootstrap.css') }}" rel="stylesheet">

    <link href="{{ asset('frontend/css/swiper.css') }}" rel="stylesheet">

    <link href="{{ asset('frontend/css/ionicons.css') }}" rel="stylesheet">

    <!-- Toster CSS -->
    <!-- <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css"> -->
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css')  }}">

    <link rel="stylesheet" href="{{ asset('frontend/custom.css')  }}">

    @stack('styles')

</head>