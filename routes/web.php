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

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/youtube_channel', [App\Http\Controllers\ChannelController::class, 'index'])->name('youtube_channel');


Route::get('/bot', [App\Http\Controllers\Filter\BotController::class, 'index'])->name('bot');
Route::post('/bot_insert', [App\Http\Controllers\Filter\BotController::class, 'insert'])->name('bot.insert');
Route::post('/bot_delete', [App\Http\Controllers\Filter\BotController::class, 'delete'])->name('bot.delete');
