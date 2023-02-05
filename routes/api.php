<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Symfony\Component\Process\Process;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/handle_webhook', function (Request $request) {
    $process = new Process(['/usr/bin/sh', '../deploy.sh']);
    $process->run();
    return $process->getOutput();
});
