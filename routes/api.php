<?php

use App\Http\Controllers\API\TaskController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::group(['middleware'=>['cors']],function(){
    Route::get('task',[TaskController::class,'index']);
    Route::get('task/{id}',[TaskController::class,'show']);
    Route::get('task-admin',[TaskController::class,'indexAdmin']);
    Route::post('task',[TaskController::class,'store']);
    Route::patch('task-edit/{id}',[TaskController::class,'update']);
    Route::delete('task-delete/{id}',[TaskController::class,'destroy']);
    Route::patch('task-complete/{id}/{check}',[TaskController::class,'completeTask']);
//});
