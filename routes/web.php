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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//ログインページ
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');

//ログイン機能
Route::post('login', 'Auth\LoginController@login');

//新規登録ページ
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');

//新規登録機能
Route::post('register', 'Auth\RegisterController@register');

//ログアウト
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


//トップページ
Route::get('/', 'LoanController@top')->name('top');
