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

Route::get('/term',['uses' => 'SearchController@getTerm','as' => 'term']);

Route::get('/add', 'WordController@add')->name('add')->middleware('auth');
Route::get('/submitted_words', 'DashboardController@submitted_words')->name('submitted_words')->middleware('auth');

Route::get('/', 'HomeController@index_recent_words')->name('welcome');

Route::get('contact', function () {
   return view('contact');
});

Route::get('suggestions', function () {
   return view('suggestions');
});

Auth::routes();

Route::post('add_word', 'WordController@add_word')->name('add_word')->middleware('auth');

Auth::routes();

Route::get('/resend_email', 'DashboardController@resent_email')->name('resend_email')->middleware('auth');

Route::get('/home', 'DashboardController@get_saved_words')->name('home')->middleware('auth');

Route::post ( '/saveword', 'WordController@save_word')->middleware('auth');
Route::post ( '/removeword', 'VoteController@delete_liked')->middleware('auth');

Route::post ( '/removesave', 'WordController@remove_word')->middleware('auth');

Route::post ( '/voteword', 'VoteController@vote_word')->middleware('auth');

Route::get('register/verify/{token}', 'Auth\RegisterController@verify'); 

Route::get('/account', 'DashboardController@account')->name('account')->middleware('auth');
Route::post('edit_account', 'DashboardController@edit_account')->name('edit_account')->middleware('auth');


///////////////////////////////////////////////////////////
// Admin only routes
///////////////////////////////////////////////////////////

Route::group(['middleware'=>'auth'], function () {

Route::get ( '/admin_main', 'DashboardAdminController@admin_main')->name('admin_main')->middleware('check-permission:admin');

Route::get('/words_check', 'DashboardAdminController@words_check')->name('words_check')->middleware('check-permission:admin');

Route::post('/checkword', 'DashboardAdminController@words_check_status')->name('checkword')->middleware('check-permission:admin');

});
