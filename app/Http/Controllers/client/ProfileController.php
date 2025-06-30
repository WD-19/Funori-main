<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;

class ProfileController 
{
    public function dashboard()
    {
        return view('client.profile.dashboard', [
            'pageTitle' => 'Dashboard'
        ]);
    }

    public function order()
    {
        return view('client.profile.order', [
            'pageTitle' => 'My Orders'
        ]);
    }

    public function address()
    {
        return view('client.profile.address', [
            'pageTitle' => 'Shipping Address'
        ]);
    }

    public function account()
    {
        return view('client.profile.account', [
            'pageTitle' => 'Account Details'
        ]);
    }

    public function wishlist()
    {
        return view('client.profile.wishlist', [
            'pageTitle' => 'My Wishlist'
        ]);
    }
}
