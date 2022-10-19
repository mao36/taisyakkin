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

//ログインページ
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');

//ログイン機能
Route::post('login', 'Auth\LoginController@login');

//新規登録ページ
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');

//新規登録機能
Route::post('register', 'Auth\RegisterController@register');

//登録完了ページ
Route::post('added', 'Auth\RegisterController@added');

Route::group(['middleware' => 'auth'], function () {

    //登録完了ページ
    Route::post('added', 'Auth\RegisterController@added');

    //ログアウト
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    //トップページ
    Route::get('/', 'LoanController@top')->name('top');

    //タイシャクリストページ
    Route::get('loans', 'LoanController@index')->name('loans.index');

    //返済済みページ
    Route::get('loans/returned', 'LoanController@returned')->name('loans.returned');

    //タイシャク登録機能
    Route::post('loan/store', 'LoanController@store')->name('loans.store');

    //貸借編集ページ
    Route::get('loans/{loan}/edit', 'LoanController@edit')->name('loans.edit');

    //貸借編集機能
    Route::put('loans/{loan}/update', 'LoanController@update')->name('loans.update');

    //タイシャク記録削除機能
    Route::delete('loans/{loan}/delete', 'LoanController@delete')->name('loans.delete');

    //お気に入りユーザーリストページ
    Route::get('likes', 'UserController@index')->name('likes.index');

    //お気に入りユーザー登録機能
    Route::post('users/{user}/like', 'UserController@like')->name('users.like');

    //お気に入りユーザー解除機能
    Route::delete('users/{user}/unlike', 'UserController@unlike')->name('users.unlike');

    //グループ一覧ページ
    Route::get('groups', 'GroupController@index')->name('groups.index');

    //グループ詳細ページ
    Route::get('groups/{group}', 'GroupController@show')->name('groups.show');

    //グループ詳細ページ/返済済み
    Route::get('groups/{group}/returned', 'GroupController@returned')->name('groups.returned');

    //グループ作成機能
    Route::post('group/store', 'GroupController@store')->name('groups.store');

    //グループ編集ページ
    Route::put('groups/{group}/edit', 'GroupController@edit')->name('groups.edit');

    //グループ名変更機能
    Route::delete('group/{group}/name-update', 'GroupController@nameUpdate')->name('groups.name.update');

    //グループ削除機能
    Route::delete('groups/{group}/delete', 'GroupController@delete')->name('groups.delete');

    //グループにユーザー登録機能
    Route::post('groups/{group}/users/{user}/add', 'GroupController@add')->name('groups.add');

    //グループからユーザー解除機能
    Route::delete('groups/{group}/users/{user}/remove', 'GroupController@remove')->name('groups.remove');

    //ユーザー検索ページ・機能
    Route::get('search', 'UserController@search')->name('search');

    //他者プロフィールページ
    Route::get('users/{user}', 'UserController@show')->name('users.show');

    //他者プロフィールページ/返済済み
    Route::get('users/{user}/returned', 'UserController@returned')->name('users.returned');

    //マイプロフィールページ
    Route::get('my-profile', 'UserController@myProfile')->name('my-profile');

    //ユーザー名変更ページ
    Route::get('name/edit', 'UserController@nameEdit')->name('name.edit');

    //ユーザー名変更機能
    Route::put('name/update', 'UserController@nameUpdate')->name('name.update');

    //メールアドレス変更ページ
    Route::get('mail/edit', 'UserController@mailEdit')->name('mail.edit');

    //メールアドレス変更機能
    Route::put('mail/update', 'UserController@mailUpdate')->name('mail.update');

    //パスワード変更ページ
    Route::get('password/edit', 'UserController@passwordEdit')->name('password.edit');

    //パスワード変更機能
    Route::put('password/update', 'UserController@passwordUpdate')->name('password.update');

    //プロフィール画像変更ページ
    Route::get('image/edit', 'UserController@imageEdit')->name('image.edit');

    //プロフィール画像変更機能
    Route::put('image/update', 'UserController@imageUpdate')->name('image.update');

});
