<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CorrespondenceController;

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

//CORRESPONDENCE ROUTES 
Route::post("AddCorrespondenceRoute",[CorrespondenceController::class,'AddCorrespondences']);
Route::get("ListCorrespondenceRoute",[CorrespondenceController::class,'ListCorrespondences']);
Route::put("updateCorrespondenceRoute/{id}",[CorrespondenceController::class,'updateCorrespondences']);
Route::delete("deleteCorrespondenceRoute/{id?}",[CorrespondenceController::class,'deleteCorrespondences']);
Route::get("getupdatedetail/{id}",[CorrespondenceController::class,'fetchCorrespondenceDetails']);

// END CORRESPONDENCE ROUTES 
