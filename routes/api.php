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

// admins
Route::post("/admins/login","AdminController@auth");

// studios
Route::get("/studios","StudioController@all");
Route::get("/studios/no_paging","StudioController@all_no_paging");
Route::get("/studios/{id}","StudioController@by_id");
Route::get("/studios/search/query","StudioController@search");
Route::get("/studios/addon/datatable","StudioController@datatable")->name("haharute");
Route::post("/studios","StudioController@store");
Route::put("/studios/{id}","StudioController@update");
Route::delete("/studios/{id}","StudioController@delete");

// contents
Route::get("/contents","ContentController@all");
Route::get("/contents/{id}","ContentController@by_id");
Route::get("/contents/search/query","ContentController@search");
Route::get("/contents/studios/{id}","ContentController@by_studio_id");
Route::post("/contents","ContentController@store");
Route::post("/contents/thumbnail/{id}","ContentController@update_thumbnail");
Route::put("/contents/{id}","ContentController@update");
Route::delete("/contents/{id}","ContentController@delete");