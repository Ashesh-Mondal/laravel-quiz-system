<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Mcq;
use App\Models\Quiz;
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
            'category' => 'required|min:3|unique:categories,name'
        ], [
            'category.required' => 'Name of the category is required!!!',
            'category.unique' => 'Category already exists'
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

    public function deleteCategory($id)
    {
        $categoryDetails = Category::find($id);
        $categoryDetails->delete();
        return back()->with('success', "Quiz for category $categoryDetails->name has been deleted");
    }

    public function addQuiz()
    {
        $userDetails = Session::get('user');
        $categoryListDetails = Category::all();
        if ($userDetails) {
            $quizName = request('quiz');
            $category_id = request('category_id');
            if ($quizName && $category_id && !Session::has('quizDetails')) {
                $quiz = new Quiz();
                $quiz->name = $quizName;
                $quiz->category_id = $category_id;
                if ($quiz->save()) {
                    Session::put('quizDetails', $quiz);
                }
            }
            return view('add-quiz', compact('userDetails', 'categoryListDetails'));
        } else {
            return redirect()->route('admin.login');
        }
    }

    public function addMCQs(Request $request)
    {
        $mcq = new Mcq();
        $mcq->question = $request->question;
        $mcq->a = $request->a;
        $mcq->b = $request->b;
        $mcq->c = $request->c;
        $mcq->d = $request->d;
        $mcq->correct_ans = $request->correct_ans;

        $userDetails = Session::get('user');
        $quizDetails = Session::get('quizDetails');
        $mcq->admin_id = $userDetails->id;
        $mcq->quiz_id = $quizDetails->id;
        $mcq->category_id = $quizDetails->category_id;
        if ($mcq->save()) {
            if ($request->submit == "add-more") {
                return redirect(url()->previous());
            } else {
                Session::forget('quizDetails');
                return redirect()->route('admin.categories');
            }
        }
    }
}
