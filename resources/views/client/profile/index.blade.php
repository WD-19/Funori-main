@extends('client.layout.client')

@section('title', 'Cửa Hàng')

@section('content')
 <div class="tf-page-title">
            <div class="container-full">
                <div class="heading text-center">My Account</div>
            </div>
 </div>
        <!-- /page-title -->
        
        <!-- page-cart -->
        <section class="flat-spacing-11">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="wrap-sidebar-account">
                            <ul class="my-account-nav">
                                <li><span class="my-account-nav-item active">Dashboard</span></li>
                                <li><a href="my-account-orders.html" class="my-account-nav-item">Orders</a></li>
                                <li><a href="my-account-address.html" class="my-account-nav-item">Address</a></li>
                                <li><a href="my-account-edit.html" class="my-account-nav-item">Account Details</a></li>
                                <li><a href="my-account-wishlist.html" class="my-account-nav-item">Wishlist</a></li>
                                <li><a href="login.html" class="my-account-nav-item">Logout</a></li>
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