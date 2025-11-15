<?php

namespace App\Http\Controllers;

use App\Mail\UserForgotPassword;
use App\Mail\VerifyUser;
use App\Models\Category;
use App\Models\Mcq;
use App\Models\McqRecord;
use App\Models\Quiz;
use App\Models\Record;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function welcome()
    {
        $categoryList = Category::withCount('quiz')->with('quiz')->orderBy('quiz_count', "desc")->take(5)->get();
        $quizList = Quiz::withCount('record')->withCount("mcq")->orderBy("record_count", "desc")->take(5)->get();
        return view('welcome', compact('categoryList', 'quizList'));
    }

    public function userCategoryList()
    {
        $categoryList = Category::withCount('quiz')->orderBy('quiz_count', 'desc')->paginate('3');
        return view('user-category-list', compact('categoryList'));
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

        // * Code for sending Verify Email

        $link = Crypt::encryptString($user->email);
        $link = url("/verify-user/" . $link);
        Mail::to($user->email)->send(new VerifyUser($link));

        //

        if ($user->save()) {
            Session::put('normalUser', $user);
            // this if condition is used so that when a user is doing signup/login from the quiz section then after after getting signedup/logedin the user will get redirected back to the same quiz section
            if (Session::has('startQuizUrl')) {
                $url = Session::get('startQuizUrl');
                Session::forget('startQuizUrl');
                return redirect($url)->with('message-success', "User registered successfully, please check email to verify user");
            } else {
                return redirect('/')->with('message-success', "User registered successfully, please check email to verify user");
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
            return back()->with("message-error", "User not valid please check the credentials");
        } else {
            Session::put('normalUser', $user);
            if (Session::has('startQuizUrl')) {
                $url = Session::get('startQuizUrl');
                Session::forget('startQuizUrl');
                return redirect($url)->with('message-success', "User Logged in successfully");
            } else {
                return redirect('/')->with('message-success', "User Logged in successfully");
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
            $currentQuiz['recordId'] = $record->id;
            $currentQuiz['quizId'] = $id;
            Session::put('currentQuiz', $currentQuiz);
            return view('mcq-page', compact('mcqData', 'name'));
        } else {
            return "Something went wrong";
        }
    }

    public function submitAndNext(Request $request)
    {
        $currentQuiz = Session::get('currentQuiz');
        $mcqRecord = new McqRecord();
        $isExist = McqRecord::where([
            ['record_id', '=', $currentQuiz['recordId']],
            ['mcq_id', '=', $request->mcq_id]
        ])->count();
        if ($isExist < 1) {
            $mcqRecord->record_id = $currentQuiz['recordId'];
            $mcqRecord->user_id = Session::get('normalUser')->id;
            $mcqRecord->mcq_id = $request->mcq_id;
            $mcqRecord->select_answer = $request->option;
            $request->option == Mcq::find($request->mcq_id)->correct_ans;
            if ($request->option == Mcq::find($request->mcq_id)->correct_ans) {
                $mcqRecord->is_correct = 1;
            } else {
                $mcqRecord->is_correct = 0;
            }
            $mcqRecord->save();
            $currentQuiz['currentMcq'] += 1;
        }
        $name = $currentQuiz['quizName'];
        $mcqData = Mcq::where('id', '>', $request->mcq_id)->where('quiz_id', '=', $currentQuiz['quizId'])->first();
        if ($mcqData) {
            Session::put('currentQuiz', $currentQuiz);
            return view('mcq-page', compact('mcqData', 'name'));
        } else {
            $record = Record::find($currentQuiz['recordId']);
            if ($record) {
                $record->status = '2';
                $record->update();
            }
            $quizResult = McqRecord::WithMCQ()->where('record_id', $currentQuiz['recordId'])->get();
            $correctAnsCount = McqRecord::where([['record_id', '=', $currentQuiz['recordId']], ['is_correct', '=', 1]])->count();
            return view('quiz-result', compact('quizResult', 'correctAnsCount'));
        }
    }

    public function userDetails()
    {
        $userDetails = Record::with('quiz')->where('user_id', '=', Session::get('normalUser')->id)->get();
        return view('user-details', compact('userDetails'));
    }

    public function searchQuiz(Request $request)
    {
        $search = $request->search;
        $quizList = Quiz::withCount('mcq')->where('name', 'LIKE', '%' . $search . '%')->get();
        return view('quiz-search', compact('quizList', 'search'));
    }

    public function verifyUser($email)
    {
        $orgEmail = Crypt::decryptString($email);
        $user = User::where('email', $orgEmail)->first();
        if ($user) {
            $user->active = '2';
            if ($user->save()) {
                return redirect('/')->with('message-success', "User verified successfully");
            }
        }
    }

    public function userForgotPassword(Request $request)
    {
        $link = Crypt::encryptString($request->email);
        $link = url("/user-forgot-password/" . $link);
        Mail::to($request->email)->send(new UserForgotPassword($link));
        return redirect('/')->with("message-success", "A password reset link has been emailed to you. Please check your inbox");
    }

    public function userResetForgotPassword($email)
    {
        $email = Crypt::decryptString($email);
        return view('user-set-forget-password', compact('email'));
    }

    public function userSetForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required | email',
            'password' => 'required|min:3|confirmed'
        ]);
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        if ($user->save()) {
            return redirect('/user-login')->with('message-success', "Password reset was successful and your new password is now active");
        }
    }
}
