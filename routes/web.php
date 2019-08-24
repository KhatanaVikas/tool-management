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

Route::get('/','HomeController@homeAction');
Route::get('/about','HomeController@aboutAction');


/**
 * TODO:: Later move these routes to api.php
 */
/**
 * Routes for tool manager
 */
Route::get('/tools/get-tool-groups','API\ToolManagerController@getToolGroupAction');
Route::post('/tools/add','API\ToolManagerController@addNewToolAction');
Route::post('/tools/edit/{tool_id}','API\ToolManagerController@updateToolAction');
Route::delete('/tools/delete/{tool_id}','API\ToolManagerController@deleteToolAction');
Route::get('/tools/view','API\ToolManagerController@getToolListAction');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
