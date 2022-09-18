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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
