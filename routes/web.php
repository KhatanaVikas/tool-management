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

Route::get('/','HomeController@index');

/**
 * TODO:: Later move these routes to api.php
 */
/**
 * Routes for tool manager
 */
Route::get('/tools/get-tool-groups','Tools\ToolController@getToolGroupAction');
Route::post('/tools/add','Tools\ToolController@addNewToolAction');
Route::post('/tools/edit/{tool_id}','Tools\ToolController@updateToolAction');
Route::delete('/tools/delete/{tool_id}','Tools\ToolController@deleteToolAction');
Route::get('/tools/view','Tools\ToolController@getToolListAction');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
