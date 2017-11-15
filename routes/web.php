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
Route::get('/submitted_words', 'WordController@submitted_words')->name('submitted_words')->middleware('auth');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::post('add_word', 'WordController@add_word')->name('add_word')->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Auth::routes();

Route::get('/home', 'DashboardController@get_saved_words')->name('home')->middleware('auth');

Route::post ( '/saveword', 'WordController@save_word')->middleware('auth');
Route::post ( '/removeword', 'VoteController@delete_liked')->middleware('auth');

Route::post ( '/removesave', 'WordController@remove_word')->middleware('auth');

Route::post ( '/voteword', 'VoteController@vote_word')->middleware('auth');

///////////////////////////////////////////////////////////
// Admin only routes
///////////////////////////////////////////////////////////

Route::get ( '/admin_main', 'AdminController@admin_main')->name('admin_main')->middleware('admin');