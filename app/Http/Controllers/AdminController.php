<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ], [
            'name.required' => 'Username Required'
        ]);
        $user = Admin::where('name', '=', $request->name)->where("password", '=', $request->password)->first();
        if (!$user) {
            $request->validate([
                'user' => 'required'
            ], [
                'user.required' => "User dosen't exists"
            ]);
        }
        $userDetails = Session::put('user', $user);
        return redirect()->route('dashboard');
    }
    public function dashboard()
    {
        $userDetails = Session::get('user');
        if ($userDetails) {
            return view('admin', compact('userDetails'));
        } else {
            return redirect()->route('admin.login');
        }
    }
}
