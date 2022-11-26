<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your module. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'help-guide', 'middleware'=>['auth:api']], function () {
    Route::get('get-all', 'HelpAndGuideController@getAllHelpAndGuide');
    Route::post('create', 'HelpAndGuideController@createHelpAndGuide');
});

