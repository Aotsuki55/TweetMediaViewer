<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/view', 'PagesController@getViewer');
Route::post('/view/status', 'PagesController@saveTmp');
Route::get('/view/find', 'PagesController@search');
Route::get('/view/delete', 'PagesController@delete');
Route::get('/connection', 'GooglePhoto@getConnection');
