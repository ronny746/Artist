<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\Payment;





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
// git add .
// git commit -m "commit"
// git push -f origin main
// Admin

//Route::get('payment',[Payment::class,'index']);
Route::get('adminlogin',[AdminController::class,'login']);
Route::post('adminregister',[AdminController::class,'register']);
Route::get('artistlogin',[ArtistController::class,'login']);

// Artist
Route::post('artistregister',[ArtistController::class,'register']);
Route::get('allartists',[ArtistController::class,'index']);
Route::get('userlogin',[PeopleController::class,'login']);


// Users
Route::post('userregister',[PeopleController::class,'register']);
Route::get('allusers',[PeopleController::class,'index']);
Route::middleware(['auth:sanctum'])->group(function(){
    
    Route::get('adminlogout',[AdminController::class,'destroy']);
    Route::get('artistlogout',[ArtistController::class,'destroy']);
    Route::get('userlogout',[PeopleController::class,'destroy']);

});

