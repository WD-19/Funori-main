<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;

class ShopController
{
    /**
     * Display the shop page.
     */
    public function index(Request $request)
    {
        // Logic to retrieve necessary data for the shop page
        // For example: products, categories, etc.

        return view('client.shop.shop'); // Return the corresponding view
    }
}
