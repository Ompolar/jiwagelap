<?php

use App\Http\Controllers\ChannelController;
use App\Http\Controllers\Filter\BotController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\YoutubeNotificationController;
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

Route::get('/', [HomeController::class, 'welcome']);

Auth::routes(['register' => false]);

Route::get('/youtube_channel', [ChannelController::class, 'index'])->name('youtube_channel');



Route::middleware(['auth'])->group(function () {

    // halaman utama setelah login
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // kelola bot, masukkan ke dalam box sebelah kiri template
    Route::get('/bot', [BotController::class, 'index'])->name('bot');
    Route::post('/bot_insert', [BotController::class, 'insert'])->name('bot.insert');
    Route::post('/bot_delete', [BotController::class, 'delete'])->name('bot.delete');


    // kelola notifikasi youtube yg bisa dikirim ke server sebagai webhook
    Route::get('/yt_notification', [YoutubeNotificationController::class, 'index'])->name('yt_notification');
    Route::post('/yt_notification_insert', [YoutubeNotificationController::class, 'insert'])->name('yt_notification.insert');
    Route::post('/yt_notification_delete', [YoutubeNotificationController::class, 'delete'])->name('yt_notification.delete');
    Route::post('/yt_notification_send_last', [YoutubeNotificationController::class, 'send'])->name('yt_notification.send_last');
});


