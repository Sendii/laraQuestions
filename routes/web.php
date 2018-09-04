<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['admin'], 'auth')->group(function() {
	Route::group(['prefix' => 'admins'], function(){
		Route::get('/', function(){
			echo "Haii Adminn";
		});
		Route::group(['prefix' => 'questions'], function(){
			Route::get('/all', 'AdminController@allQuestion');

		});
	});
});

$name = \App\User::where('name')->get();
Route::middleware(['user'], 'auth')->group(function() {
	Route::get('account/{name}', 'UserController@myAccount');
	Route::get('accounts', 'UserController@allAccount');
	Route::get('{name}/{questions_code}', 'UserController@myQuestions_code');
	Route::post('question/save', 'UserController@saveQuestion');
	Route::get('accounts/search/' , 'UserController@search');
	Route::get('accounts/settings', 'UserController@settings');


	Route::get('tan', function() {
		$test = Auth::user()->id;
		$a = \App\Question::where('user_id_to', '=', $test)->count();
		$followings = \App\Follow::where('leader_id', $test)->count();
		$totalfollowings = \App\User::where('id', $test)->get();
		$followers = \App\Follow::where('to_id', $test)->count();
		echo "id anda ".$test. "<br>";
		echo "jumlah pertanyaan anda ada ".$a. "<br>";
		echo "jumlah followings anda ada ".$followings. "<br>";
		echo "followings : ".$totalfollowings. "<br>";
		echo "jumlah followers anda ada ".$followers . "<br>";
	});
});

Route::get('contacts', function() {
	echo "Halooo admin";
});
Route::get('info', function() {
	echo "Halooo ini info";
});