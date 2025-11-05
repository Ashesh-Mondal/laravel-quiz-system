<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function welcome()
    {
        $categoryList = Category::latest()->take(8)->get();
        return view('welcome', compact('categoryList'));
    }
}
