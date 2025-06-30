@extends('client.layout.client')

@section('title', 'Cửa Hàng')

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
                        <div class="wrap-sidebar-account">
                            <ul class="my-account-nav">
                                <li><a href="{{ route('client.profile.dashboard') }}" class="my-account-nav-item">Dashboard</a></li>
                                <li><a href="{{ route('client.profile.order') }}" class="my-account-nav-item">Orders</a></li>
                                    <li><a href="{{ route('client.profile.address') }}" class="my-account-nav-item">Address</a></li>
                                    <li><a href="{{ route('client.profile.account') }}" class="my-account-nav-item">Account Details</a></li>
                                    <li><a href="{{ route('client.profile.wishlist') }}" class="my-account-nav-item">Wishlist</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        @yield('content_profile')
                    </div>
                </div>
            </div>
        </section>
        <!-- page-cart -->
@endsection