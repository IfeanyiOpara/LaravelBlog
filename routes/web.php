<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
// Route::get('/profile', 'PagesController@profile');
Route::get('/services', 'PagesController@services');
Route::post('/search_user', 'PagesController@search_user');
Route::post('/search_post', 'PagesController@search_post');


// Route::get('/add', function(){
//     return \App\User::find(5)->add_friends(6);
// });

Route::get('/add/{user_requested_id}/{requester}', function($user_requested_id, $requester){
    \App\User::find($user_requested_id)->add_friends($requester);

    // $user = Auth()->user()->id;
    // $pendings = \App\User::find($user)->pending_friend_request();

    return redirect('/posts');
});

Route::get('/to/{user_requested_id}/{requester}', function($user_requested_id, $requester){
    return \App\User::find($user_requested_id)->has_pending_friend_request_from($requester);

    // $user = Auth()->user()->id;
    // $pendings = \App\User::find($user)->pending_friend_request();
});

Route::get('/accept/{user_requested_id}/{requester}', function($user_requested_id, $requester){
        \App\User::find($user_requested_id)->accept_friend($requester);

        $user = Auth()->user()->id;
        $pendings = \App\User::find($user)->pending_friend_request();

        return view('pages.notification')->with('pendings',$pendings);
});

Route::get('/decline/{user_requested_id}/{requester}', function($user_requested_id, $requester){
    \App\User::find($user_requested_id)->decline_friend($requester);

    $user = Auth()->user()->id;
    $pendings = \App\User::find($user)->pending_friend_request();

    return view('pages.notification')->with('pendings',$pendings);
});

Route::get('/pending_', function(){
    return \App\User::find(4)->pending_friend_request();
});

Route::get('/pending_friends', 'PagesController@notification');

Route::get('/friends', function(){
    return \App\User::find(1)->friends();
});

Route::get('/ids', function(){
    return \App\User::find(4)->friend_ids();
});

Route::get('/is', function(){
    return \App\User::find(4)->is_friends_with(1);
});

Route::get('/pending', function(){
    return \App\User::find(1)->pending_friend_request();
});

Route::get('/pending_ids', function(){
    return \App\User::find(4)->pending_friend_request_ids();
});

Route::get('/pending_friend_request_sent', function(){
    return \App\User::find(2)->pending_friend_request_sent();
});

Route::get('/has_pending_friend_request_from', function(){
    return \App\User::find(4)->has_pending_friend_request_from(1);
});

Route::resource('posts', 'PostsController');
Route::resource('profile','ProfileController');


Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
Route::post('/comment', 'PostsController@comment');
