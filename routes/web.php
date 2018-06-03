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

$name = \App\User::where('name');
Route::middleware(['user'], 'auth')->group(function() {
	if(empty($name)) {
		Route::get('account/{name}', 'UserController@myAccount');
	}else {
		Route::get('account/404', function() {
			echo "masalah uyy";
		});
	}
	Route::get('account/{name}/{questions_code}', 'UserController@myQuestions_code');
	Route::post('question/save', 'UserController@saveQuestion');
});