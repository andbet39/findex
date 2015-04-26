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

$app->post('file', '\App\Http\Controllers\FileController@saveFile');
$app->get('list', '\App\Http\Controllers\FileController@getFileList');
$app->get('view/{filename}', '\App\Http\Controllers\FileController@viewFile');
$app->get('delete/{filename}', '\App\Http\Controllers\FileController@deleteFile');



$app->get('testguz', '\App\Http\Controllers\FileController@testguz');
$app->get('search/{term}', '\App\Http\Controllers\FileController@search');
$app->get('reindex', '\App\Http\Controllers\FileController@reindex');
