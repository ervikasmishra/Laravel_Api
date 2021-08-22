<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\controllers\Api;
use App\Http\controllers\AuthorsController;


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

Route::middleware('auth:api')->prefix('v1')->group(function(){
    Route::get('/user', function (Request $request) {
    return $request->user();
    });
    
});
// Route::get('/authors/{author}',[AuthorsController::class, 'show']);
Route::apiResource('/authors',AuthorsController::class);


//  PASSPORT //

Route::post('/register',[Api::class,'register']);
Route::post('/login',[Api::class,'login']);
Route::get('view',[Api::class,'view']);

//author/{author}
// for one specific author