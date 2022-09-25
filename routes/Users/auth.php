<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeopleController;

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
Route::get('userlogin',[PeopleController::class,'login']);
Route::post('userregister',[PeopleController::class,'register']);
Route::middleware(['auth:sanctum'])->group(function(){
    
    Route::get('userlogout',[PeopleController::class,'destroy']);

});

