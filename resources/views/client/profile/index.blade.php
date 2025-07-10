@extends('client.layout.client')

@section('title', $pageTitle ?? 'My Account')

@section('content')
    <div class="tf-page-title">
        <div class="container-full">
            <div class="heading text-center">{{ $pageTitle ?? 'My Account' }}</div>
        </div>
    </div>
    <!-- /page-title -->

    <!-- page-cart -->
    <section class="flat-spacing-11">
        <div class="container1">
            <div class="row">
                <div class="col-lg-3">
                    @include('client.profile.sidebar')
                </div>
                <div class="col-lg-9">
                    @yield('content_profile')
                </div>
            </div>
        </div>
    </section>
    <!-- page-cart -->
@endsection
