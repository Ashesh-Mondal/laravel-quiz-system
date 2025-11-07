<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Mcq;
use App\Models\Quiz;
use App\Models\Record;
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
        $quizData = Quiz::with(['category', 'mcq'])->where('id', $id)->first();
        return view('start-quiz', compact('quizData'));
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

    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return "User nopt valid please check the credentials";
        } else {
            Session::put('normalUser', $user);
            if (Session::has('startQuizUrl')) {
                $url = Session::get('startQuizUrl');
                Session::forget('startQuizUrl');
                return redirect($url);
            } else {
                return redirect('/');
            }
        }
    }

    public function userLoginQuiz()
    {
        $previousUrl = url()->previous();
        Session::put('startQuizUrl', $previousUrl);
        return view('user-login');
    }

    public function mcq($id, $name)
    {
        $mcq = Mcq::where('quiz_id', $id)->get();
        $mcqData = $mcq[0];
        $record = new Record();
        $record->user_id = Session::get('normalUser')->id;
        $record->quiz_id = $id;
        if ($record->save()) {
            $currentQuiz = [];
            $currentQuiz['currentMcq'] = 1;
            $currentQuiz['totalMcq'] = $mcq->count();
            $currentQuiz['quizName'] = $name;
            $currentQuiz['quizId'] = $id;
            Session::put('currentQuiz', $currentQuiz);
            return view('mcq-page', compact('mcqData', 'name'));
        } else {
            return "Something went wrong";
        }
    }

    public function submitAndNext($mcqId)
    {
        $currentQuiz = Session::get('currentQuiz');
        if ($currentQuiz['currentMcq'] < $currentQuiz['totalMcq']) {
            $currentQuiz['currentMcq'] += 1;
            $name = $currentQuiz['quizName'];
            $mcqData = Mcq::where('id', '>', $mcqId)->where('quiz_id', '=', $currentQuiz['quizId'])->first();
            if ($mcqData) {
                Session::put('currentQuiz', $currentQuiz);
                return view('mcq-page', compact('mcqData', 'name'));
            }
        } else {
            return "Congratulations! You have completed the quiz";
        }
    }
}
