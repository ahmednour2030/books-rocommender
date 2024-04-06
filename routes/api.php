<?php

use App\Http\Controllers\ReadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['prefix'=> 'books'], function (){
    Route::post('reading', [ReadController::class, 'storeReadingBook']);
    Route::get('recommended', [ReadController::class, 'calculateRecommendedBooks']);
});


