<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$app->get('/', function() use ($app) {
    return $app->welcome();
});

$app->post('files', '\App\Http\Controllers\FileController@postFile');
$app->get('listfile', '\App\Http\Controllers\FileController@getFileList');
$app->get('testguz', '\App\Http\Controllers\FileController@testguz');