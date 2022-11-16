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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tweet', 'App\Http\Controllers\Tweet\IndexController@index')
->name('tweet.index');
Route::middleware('auth')->group(function() {
    Route::get('/tweet/{tweetId}/likes', 'App\Http\Controllers\Tweet\IndexController@likes')
    ->name('like.likes');
    Route::get('/tweet/{tweetId}', 'App\Http\Controllers\Tweet\IndexController@show')
    ->name('tweet.show');
    Route::post('/tweet/create', 'App\Http\Controllers\Tweet\IndexController@create')
    ->name('tweet.create');
    Route::get('/tweet/update/{tweetId}', 'App\Http\Controllers\Tweet\IndexController@update')
    ->name('tweet.update');
    Route::put('/tweet/update/{tweetId}', 'App\Http\Controllers\Tweet\IndexController@put')
    ->name('tweet.put');
    Route::delete('/tweet/delete/{tweetId}', 'App\Http\Controllers\Tweet\IndexController@delete')
    ->name('tweet.delete');

    Route::post('/tweet/like/{tweetId}', 'App\Http\Controllers\Tweet\IndexController@like')
    ->name('tweet.like');
    Route::delete('/tweet/unlike/{tweetId}', 'App\Http\Controllers\Tweet\IndexController@unlike')
    ->name('tweet.unlike');

    Route::get('/user/{userId}', 'App\Http\Controllers\Account\AccountController@show')
    ->name('user.show');
    Route::post('/user/{userId}/follow', 'App\Http\Controllers\Account\AccountController@follow')
    ->name('user.follow');
    Route::post('/user/{userId}/unfollow', 'App\Http\Controllers\Account\AccountController@unfollow')
    ->name('user.unfollow');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
