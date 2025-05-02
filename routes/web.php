<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BotmanController;
use App\Http\Controllers\MessengerController;

Route::get('/', function () {
    return view('welcome');
});

Route::match(['get', 'post'], '/botman', [BotmanController::class, 'handle']);

Route::get('/chat', function () {
    return view('chat');
});

// Route::middleware(['auth'])->group(function () {
//     Route::post('/send-message', [MessengerController::class, 'sendMessage'])->name('send.message');
// });