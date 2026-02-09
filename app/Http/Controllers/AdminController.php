<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
      public function dashboard()
    {
        //contar el numero de usuarios
        $userCount = User::count();
        return view('admin.dashboard', compact('userCount'));
    }
}
