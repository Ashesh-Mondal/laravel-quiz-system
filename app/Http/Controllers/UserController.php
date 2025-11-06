<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3|confirmed' //* The password field must have a matching field named password_confirmation, and both must contain the same value.
        ], ['password.confirmed' => 'Password and Confirm Password does not match']);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if ($user->save()) {
            Session::put('normalUser', $user);
            // this if condition is used so that when a user is doing signup/login from the quiz section then after after getting signedup/logedin the user will get redirected back to the same quiz section
            if (Session::has('startQuizUrl')) {
                $url = Session::get('startQuizUrl');
                Session::forget('startQuizUrl');
                return redirect($url);
            } else {
                return redirect('/');
            }
        }
    }

    public function logoutUser()
    {
        Session::forget('normalUser');
        return redirect('/');
    }

    public function userSignupQuiz()
    {
        $previousUrl = url()->previous();
        Session::put('startQuizUrl', $previousUrl);
        return view('user-signup');
    }
}
