<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CorrespondenceController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\UserController; 



 
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

//USER ROUTES 
Route::post("AddUserRoute",[UserController::class,'AddUsers']);
Route::get("ListUserRoute",[UserController::class,'ListUsers']);
Route::put("updateUserRoute/{id}",[UserController::class,'updateUsers']);
Route::delete("deleteUserRoute/{id?}",[UserController::class,'deleteUsers']);
Route::get("getUserupdatedetail/{id}",[UserController::class,'fetchUserDetails']);

Route::get("testchild/{id}",[CorrespondenceController::class,'test']);
// Route::get("testchild2/{id},{name}",[CorrespondenceController::class,'test2']);
// Route::get("testchild2/{nam}",[CorrespondenceController::class,'test2']);



// END USER ROUTES 

//CORRESPONDENCE ROUTES 
Route::post("AddCorrespondenceRoute",[CorrespondenceController::class,'AddCorrespondences']);
Route::get("ListCorrespondenceRoute",[CorrespondenceController::class,'ListCorrespondences']);
Route::put("updateCorrespondenceRoute/{id}",[CorrespondenceController::class,'updateCorrespondences']);
Route::delete("deleteCorrespondenceRoute/{id?}",[CorrespondenceController::class,'deleteCorrespondences']);
Route::get("getCorrespondenceupdatedetail/{id}",[CorrespondenceController::class,'fetchCorrespondenceDetails']);

Route::get("testchild/{id}",[CorrespondenceController::class,'test']);
// Route::get("testchild2/{id},{name}",[CorrespondenceController::class,'test2']);
// Route::get("testchild2/{nam}",[CorrespondenceController::class,'test2']);



// END CORRESPONDENCE ROUTES 


//FILE ROUTES 
Route::post("AddFileRoute",[FileController::class,'AddFiles']);
Route::get("ListFileRoute",[FileController::class,'ListFiles']);
Route::put("updateFileRoute/{id}",[FileController::class,'updateFiles']);
Route::delete("deleteFileRoute/{id?}",[FileController::class,'deleteFiles']);
Route::get("getFileupdatedetail/{id}",[FileController::class,'fetchFileDetails']);

Route::get("GetFileCorrespondenceRoute/{id}",[CorrespondenceController::class,'GetAddFileCorrespondences']);
Route::get("testparent/{id}",[FileController::class,'test']);


// Add document in file
// Route::post("AddDocumentFileRoute",[FileController::class,'documentAddInFileModule']);
 


// END FILE ROUTES 



// DOCUMENT ROUTES IN FILE MODULE

Route::post("AddDocumentRoute",[DocumentController::class,'AddDocuments']);
Route::get("ListDocumentRoute",[DocumentController::class,'ListDocuments']);
Route::put("updateFileRoute/{id}",[FileController::class,'updateFiles']);
Route::delete("deleteFileRoute/{id?}",[FileController::class,'deleteFiles']);
Route::get("getupdatedetail/{id}",[FileController::class,'fetchFileDetails']);

Route::get("GetFileCorrespondenceRoute/{id}",[CorrespondenceController::class,'GetAddFileCorrespondences']);
Route::get("testparent/{id}",[FileController::class,'test']);

Route::post("testpdf",[DocumentController::class,'testUpload']);


// END DOCUMENT ROUTES


//DOCUMENT ROUTES IN DOCUMENTS MODULE 
Route::post("AddFileRoute",[FileController::class,'AddFiles']);
Route::get("ListFileRoute",[FileController::class,'ListFiles']);
Route::put("updateFileRoute/{id}",[FileController::class,'updateFiles']);
Route::delete("deleteDocumentRoute/{id?}",[DocumentController::class,'deleteDocuments']);
Route::get("getdocumentupdatedetail/{id}",[DocumentController::class,'fetchDocumentDetails']);
Route::get("downloadDocumentRoute/{id}",[DocumentController::class,'downloadDocuments']);
Route::get("previewDocumentRoute/{id}",[DocumentController::class,'previewDocuments']);


Route::get("GetFileCorrespondenceRoute/{id}",[CorrespondenceController::class,'GetAddFileCorrespondences']);
Route::get("testparent/{id}",[FileController::class,'test']);


// Add document in file
// Route::post("AddDocumentFileRoute",[FileController::class,'documentAddInFileModule']);
 


// END DOCUMENT ROUTES IN DOCUMENTS MODULE 
