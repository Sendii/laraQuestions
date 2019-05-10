<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Question;
use \App\Answer;
use \App\User;
use Auth;

class UserController extends Controller
{
    public function myAccount($name) {
    	$account = User::where('name', $name)->first();
      $accounts = User::where('name', $name)->value('name');
      //Jika akun yang diketik tidak ada
        if (is_null($accounts)) {
            echo "maaf account ".$name. " tidak ditemukan.";
        }elseif ($accounts == Auth::user()->name) {
          $question = Question::orderBy('id', 'DESC')->paginate(5);
           return view('user/account.accounts')->with(['accounts' => $account, 'questions' => $question]);
        }else{
           $question = Question::wherePrivacy('public')->orderBy('id', 'DESC')->paginate(5);
           return view('user/account.accounts')->with(['accounts' => $account, 'questions' => $question]);
       }
   }

   public function allAccount() {
    $account = User::where('name', '!=', Auth::user()->name)->get();
    return view('user/account.all')->with(['accounts' => $account]);
}

public function saveQuestion(Request $r) {
   $questions_code = str_random(11);

   $newquestion = new Question;
   if ($r->input('privacy') == "Public") {
     $newquestion->privacy = "Public";
   }elseif ($r->input('privacy') == "Private") {
     $newquestion->privacy = "Private";
   }else{
     echo "something is Error";
   }
   $newquestion->user_id_from = $r->input('useridfrom');
   $newquestion->user_id_to = $r->input('useridto');
   $newquestion->questions = $r->input('question');
   $newquestion->questions_code = $questions_code;

   $newquestion->save();
   return back();
}

public function myQuestions_code($name, $questions_code) {
  $quest = Question::whereQuestions_code($questions_code)->value('questions_code');
  $akun = User::whereName($name)->value('name');
    if(is_null($quest)) {
      echo "maaf data pertanyaan tidak ditemukan";
    }else{
          $question_code = Question::where('questions_code', $questions_code)->get();
          return view('user/account.myquestions')->with(['question_codes' => $question_code]);
    }
}

public function search(Request $r)
{
      $query = $r->input('query');
      $nameaccount = User::where('name','like','%'.$query.'%')->get();

      if (is_null($nameaccount)) {
        echo "data akun ".$query." tidak ditemukan";
      }elseif ($nameaccount != null) {
        return view('user/account.search')->with(['nameaccounts' => $nameaccount]);
      }
}

public function settings() {
  $a = Auth::user()->id;
  $name = User::where('id', $a)->value('name');

  echo "haloo ".$name;
}

public function saveAnswer(Request $r) {
  $quest = Question::whereQuestions_code($r->input('questions_code'))->value('id');
  if (is_null($quest)) {
    echo "data tidak ditemukan";
  }else {
    $new = new Answer;
    $new->id_questions = $quest;
    $new->answer = $r->input('answer');

    $new->save();
    return back();
  }
}

public function banned($name) {
  $nama = User::whereName($name)->first();
  $akun = User::whereName($name)->value('status');
  if ($akun == "Safe") {
    $nama->status = "Unsafe";
    $nama->save();
    return back();
  }elseif ($akun == "Unsafe") {
    $nama->status = "Blocked";
    $nama->save();
    return back();
  }
}

public function showAnswer($id) {
  $quest['questions'] = Answer::where('id_questions',$id)->first();
  if (isset($quest['questions'])) {
    return view('question.show', $quest);
  }else{
    echo "whopppss aDaa salaahhh";
  }
}
}