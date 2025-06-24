<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;

class ClientController
{
    public function index()
    {
        return view('client.home');
    }
}
