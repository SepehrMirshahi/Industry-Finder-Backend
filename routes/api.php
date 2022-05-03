<?php

use Illuminate\Http\Request;
use \App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\AdController;
use \App\Http\Controllers\BookmarkController;
use Illuminate\Support\Facades\Route;

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

Route::post('/user/signup', [UserController::class,'Register']);
Route::post('/user/login',[UserController::class,'Login']);
Route::post('/company/search', [CompanyController::class, 'index']);
Route::get('/ad/search', [AdController::class, 'index']);
Route::post('/company/show/{id}', [CompanyController::class, 'show']);

//protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
	//*** User ***//
	Route::get('/user/logout',[UserController::class,'Logout']);
	Route::get('/user/this',[UserController::class,'loggedInUser']);
	Route::post('/user/changepass',[UserController::class,'ChangePass']);
	Route::post('/user/update',[UserController::class,'update']);
	//*** Bookmark ***//
	Route::get('/user/bookmarks',[BookmarkController::class,'index']);
	Route::get('/user/bookmarks/add/{id}',[BookmarkController::class,'store']);
	Route::delete('/user/bookmarks/del/{id}',[BookmarkController::class,'destroy']);
	//*** Ad ***//
	Route::post('/ad/makead', [AdController::class, 'makeAd']);
	Route::post('/ad/accept', [AdController::class, 'Accept']);
	Route::delete('/ad/del/{id}', [AdController::class, 'destroy']);
	//*** Company ***//
	Route::post('/company/add', [CompanyController::class, 'store']);
	Route::post('/company/update/{id}', [CompanyController::class, 'update']);
	Route::delete('/company/delete/{id}', [CompanyController::class, 'destroy']);
	//*** Request ***//
    Route::post('/request/add', [RequestController::class, 'makeRequest']);
    Route::get('/request/accept/{id}', [RequestController::class, 'Accept']);
    Route::get('/request/reject/{id}', [RequestController::class, 'Reject']);
    Route::delete('/request/del/{id}', [RequestController::class, 'Destroy']);
});
