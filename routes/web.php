<?php

use App\Http\Controllers\TextToSpeechController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TextToSpeechController::class, 'showForm']);
Route::post('/convert', [TextToSpeechController::class, 'convertText']);