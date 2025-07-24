{{-- filepath: resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Admin Dashboard')</title>
    <!-- CSS & meta -->
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animation.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('font/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('icon/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/favicon.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    @stack('head')

    <style>
        /* Loader full screen */
        #preload {
            position: fixed;
            z-index: 9999;
            inset: 0;
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        #preload.fade-out {
            opacity: 0;
            visibility: hidden;
        }

        .preloading i {
            font-size: 5rem;
            color: #333;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <!-- Loader -->
    <div id="preload">
        <div class="preloading">
            <i class="fas fa-spinner"></i>
        </div>
    </div>

    <div id="wrapper">
        <div id="page">
            <div class="layout-wrap">
                @include('admin.partials.sidebar')
                <div class="section-content-right">
                    @include('admin.partials.header')
                    <div class="main-content">
                        <!-- main-content-wrap -->
                        <div class="main-content-inner">
                            <!-- main-content-wrap -->
                            <div class="main-content-wrap">
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
                                @yield('content')

                                @include('admin.partials.footer')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fade-out effect on load -->
    <script>
        window.addEventListener('load', function() {
            const preload = document.getElementById('preload');
            preload.classList.add('fade-out');
        });
    </script>

    <!-- JS -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/zoom.js') }}"></script>
    <script src="{{ asset('js/morris.min.js') }}"></script>
    <script src="{{ asset('js/raphael.min.js') }}"></script>
    <script src="{{ asset('js/morris.js') }}"></script>
    <script src="{{ asset('js/jvectormap.min.js') }}"></script>
    <script src="{{ asset('js/jvectormap-us-lcc.js') }}"></script>
    <script src="{{ asset('js/jvectormap-data.js') }}"></script>
    <script src="{{ asset('js/jvectormap.js') }}"></script>
    <script src="{{ asset('js/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('js/apexcharts/line-chart-1.js') }}"></script>
    <script src="{{ asset('js/apexcharts/line-chart-2.js') }}"></script>
    <script src="{{ asset('js/apexcharts/line-chart-3.js') }}"></script>
    <script src="{{ asset('js/apexcharts/line-chart-4.js') }}"></script>
    <script src="{{ asset('js/apexcharts/line-chart-5.js') }}"></script>
    <script src="{{ asset('js/apexcharts/line-chart-6.js') }}"></script>
    <script src="{{ asset('js/apexcharts/line-chart-7.js') }}"></script>
    <script src="{{ asset('js/switcher.js') }}"></script>
    <script defer src="{{ asset('js/theme-settings.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @stack('scripts')
</body>

</html>
