<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use \App\Question;

class AdminController extends Controller
{
    public function allQuestion() {
    	$data = Question::paginate(20);
    	return view('admin/questions.all', ['questions' => $data]);
    }
}
