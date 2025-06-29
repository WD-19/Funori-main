<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('client/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/blog.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/shop.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/main-mobile.css') }}">

    <link rel="stylesheet" href="{{ asset('client/ecomus/fonts/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('client/ecomus/fonts/font-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('client/ecomus/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/ecomus/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/ecomus/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('client/ecomus/css/styles.css') }}">

    <title>@yield('title')</title>
</head>

<body>
    <!-- Phần header -->
    @include('client.partials.header')

    @if (session('success'))
        <x-alert type="success">
            {{ session('success') }}
        </x-alert>
    @endif

    @if (session('error'))
        <x-alert type="danger">
            {{ session('error') }}
        </x-alert>
    @endif

    <!-- Phần nội dung chính -->
    @yield('content')

    <!-- Phần footer -->
    @include('client.partials.footer')
    <!-- <div style="margin-bottom: 600px;"></div> -->
</body>

<script src="https://kit.fontawesome.com/eda05fcf5c.js" crossorigin="anonymous"></script>
<script src="{{ asset('client/js/main.js') }}"></script>

<script src="{{ asset('client/ecomus/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('client/ecomus/js/jquery.min.js') }}"></script>
<script src="{{ asset('client/ecomus/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('client/ecomus/js/carousel.js') }}"></script>
<script src="{{ asset('client/ecomus/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('client/ecomus/js/lazysize.min.js') }}"></script>
<script src="{{ asset('client/ecomus/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('client/ecomus/js/count-down.js') }}"></script>
<script src="{{ asset('client/ecomus/js/wow.min.js') }}"></script>
<script src="{{ asset('client/ecomus/js/multiple-modal.js') }}"></script>
<script src="{{ asset('client/ecomus/js/main.js') }}"></script>

</html>
