<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Quiz;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function welcome()
    {
        $categoryList = Category::with('quiz')->latest()->take(8)->get();
        return view('welcome', compact('categoryList'));
    }

    public function userQuizList($id)
    {
        $categoryName = Category::where('id', $id)->select('name')->first();
        $quizList = Quiz::where('category_id', $id)->get();
        return view('user-quiz-list', compact('quizList', 'categoryName'));
    }
}
