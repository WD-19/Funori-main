<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class UserController
{
   public function index()
   {
        $users = User::paginate(5);
        return view('admin.users.index', compact('users'));

   }

   public function create()
   {
      $users = User::all();
      return view('admin.users.create', compact('users'));
   }
}
