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
        if ($account == null) {
            echo "maaf account ".$name. " tidak ditemukan.";
        }else{
           $question = Question::paginate(15);
           return view('user/account.accounts')->with(['accounts' => $account, 'questions' => $question]);
       }
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

public function search(Request $r)
{
      $query = $r->input('query');
      $nameaccount = User::where('name','like','%'.$query.'%')->get();

      if ($nameaccount != null) {
        return view('user/account.search')->with(['nameaccounts' => $nameaccount]);
      }elseif (!$nameaccount != null) {
        echo "data akun ".$query." tidak ditemukan";
      }
}

public function settings() {
  $a = Auth::user()->id;
  $name = User::where('id', $a)->value('name');

  echo "haloo ".$name;
}
}