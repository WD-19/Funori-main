<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;

class AboutController
{
    /**
     * Display the about page.
     */
    public function index(Request $request)
    {
        // Logic to retrieve necessary data for the about page
        // For example: company information, team members, etc.

        return view('client.about.about'); // Return the corresponding view
    }
}
