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


    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
</head>

<body>
    <!-- Phần header -->
    @include('client.partials.header')


    <!-- Phần nội dung chính -->
    @yield('content')

    <!-- Phần footer -->
    @include('client.partials.footer')
    <!-- <div style="margin-bottom: 600px;"></div> -->
</body>
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/687856501786aa1911e6b66b/1j0b12bap';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<!--End of Tawk.to Script-->
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
<script type="text/javascript" src="js/rangle-slider.js"></script>

<!-- Toastr JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</html>
