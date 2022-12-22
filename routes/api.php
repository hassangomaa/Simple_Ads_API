<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\API\AdsController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\TagController;

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

#test
Route::get('/v1', function () {
    return view('welcome');
});


#put pre path defined
#put resource
//
//Route::resource('/slide-show', 'SlideShowController');
//Route::post('/slide-show/toggleActive/{slideShow}', 'SlideShowController@toggleActive')->name('slide-show.toggleActive');
//
Route::group(['middleware' => ['api', 'XssSanitizer'], 'namespace' => 'Api'], function () {
    // 
    Route::resources([
        'ads' => AdsController::class,
        'tags' => TagController::class,
        'categories' => CategoryController::class,
    ]);
    //Route::resource('/slide-show', 'SlideShowController');

    // Route::get('ads', [AdsController::class,'index']);
    //    Route::get('/ads', 'index@AdsController')->name('all_ads');
});




//Route::get('/ads/', function ($id) {
//    return new UserResource(User::findOrFail($id));
//});
############
//Route::resource('tags', Tags );
//
//Route::group(['prefix' => 'reel'],function () {
//
//    Route::post('show', [\App\Http\Controllers\API\ReelController::class, 'show']);
//    Route::post('store', [\App\Http\Controllers\API\ReelController::class, 'store']);
//    Route::post('update', [\App\Http\Controllers\API\ReelController::class, 'update']);
//    Route::post('destroy', [\App\Http\Controllers\API\ReelController::class, 'destroy']);
//});
