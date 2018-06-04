<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Question;
use \App\User;
use Auth;

class UserController extends Controller
{
    public function myAccount($name) {
    	$account = User::where('name', $name)->first();
    	$question = Question::paginate(15);
    	return view('user/account.accounts')->with(['accounts' => $account, 'questions' => $question]);
    }

    public function allAccount() {
        $account = User::all();
        return view('user/account.all')->with(['accounts' => $account]);
    }

    public function saveQuestion(Request $r) {
    	$questions_code = str_random(11);
    	$newquestion = new Question;
    	$newquestion->user_id_from = $r->input('useridfrom');
    	$newquestion->user_id_to = $r->input('useridto');
    	$newquestion->questions = $r->input('question');
    	$newquestion->questions_code = $questions_code;

    	$newquestion->save();
    	return back();
    }

    public function myQuestions_code($name, $questions_code) {
        $question_code = Question::where('questions_code', $questions_code)->get();
        return view('user/account.myquestions')->with(['question_codes' => $question_code]);
    }
}
