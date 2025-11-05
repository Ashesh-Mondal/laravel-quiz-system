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
        $quizList = Quiz::withCount('mcq')->where('category_id', $id)->get();
        return view('user-quiz-list', compact('quizList', 'categoryName'));
    }

    public function startQuiz($id)
    {
        $quizName = Quiz::with(['category', 'mcq'])->where('id', $id)->first();
        return view('start-quiz', compact('quizName'));
    }

    public function userSignup(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required|min:3|confirmed' //* The password field must have a matching field named password_confirmation, and both must contain the same value.
        ], ['password.confirmed' => 'Password and Confirm Password does not match']);
    }
}
