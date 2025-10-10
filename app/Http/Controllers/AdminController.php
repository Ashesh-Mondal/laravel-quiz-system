<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function login(Request $request)
    {
        $user = Admin::where('name', '=', $request->name)->first();
        return view('admin', compact('user'));
    }
}
