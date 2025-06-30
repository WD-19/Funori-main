<?php

namespace App\Http\Controllers\client;

use App\Models\ContactSubmission;
use Illuminate\Http\Request;

class ContactController
{
    /**
     * Display the contact page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('client.contact.contact');
    }

    function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        ContactSubmission::create([
            'name' => $request->name,
            'email' =>$request->email,
            'message' => $request->message,
            'status' => 'new', // Mặc định trạng thái là 'new'
        ]);

        // Redirect back with a success message
        return redirect()->route('client.contact')->with('success', 'Lời nhắn của bạn đã được ghi nhận!');
    }
}
