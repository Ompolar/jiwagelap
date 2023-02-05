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
    $output = $process->getOutput();

    // tambah webhook ke discord jiwagelap,
    // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
    $ch = curl_init();


    curl_setopt($ch, CURLOPT_URL, env('DISCORD_WEBHOOK_URL'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    $curl_data = [
        'username' => env('DISCORD_WEBHOOK_USERNAME'),
        'content'   => 'test123'
    ];
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($curl_data));

    $headers = array();
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

    return $output;
});
