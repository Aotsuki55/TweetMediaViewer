<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/view', 'Api\PagesControllerApi@getViewer');
Route::post('/view/status', 'Api\PagesControllerApi@saveTmp');
Route::get('/view/find', 'Api\PagesControllerApi@search');
Route::get('/view/delete', 'Api\PagesControllerApi@delete');
Route::get('/login', 'Api\PagesControllerApi@login');
Route::get('/connection', 'GooglePhoto@getConnection');
