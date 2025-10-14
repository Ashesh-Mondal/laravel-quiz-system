<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
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
        $userDetails = Admin::where('name', '=', $request->name)->where("password", '=', $request->password)->first();
        if (!$userDetails) {
            $request->validate([
                'user' => 'required'
            ], [
                'user.required' => "User dosen't exists"
            ]);
        }
        Session::put('user', $userDetails);
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

    public function categories()
    {
        $categoryDetails = Category::all();
        $userDetails = Session::get('user');
        if ($userDetails) {
            return view('categories', compact('userDetails', 'categoryDetails'));
        } else {
            return redirect()->route('admin.login');
        }
    }

    public function logout()
    {
        Session::forget('user');
        return redirect()->route('admin.login');
    }

    public function addCategory(Request $request)
    {
        $request->validate([
            'category' => 'required'
        ], [
            'category.required' => 'Name of the category is required!!!'
        ]);

        $category = new category();
        $category->name = $request->category;
        $category->creator = Session::get('user')->name;
        $category->save();
        // if ($category->save()) {
        //     Session::flash('category', 'Category ' . $request->category . ' succesfully added');
        // }
        // return redirect()->back();
        return back()->with('success', "Quiz for category $request->category has been added successfully");
    }
}
