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

Route::get('/db/clean', 'DBController@clean');

Route::group(['prefix' => 'genero'], function () {
    Route::get('/', 'GeneroController@index');
    Route::get('/{id}', 'GeneroController@show');
});

Route::group(['prefix' => 'habilidade'], function () {
    Route::get('/', 'HabilidadeController@index'); // ok
    Route::get('/{id}', 'HabilidadeController@show');
    Route::post('/', 'HabilidadeController@store'); // ok
    Route::put('/{id}', 'HabilidadeController@update');
});

Route::group(['prefix' => 'voluntariohabilidades'], function () {
    Route::get('/', 'VoluntarioHabilidadesController@index');
    Route::get('/{id}', 'VoluntarioHabilidadesController@show');
    Route::post('/', 'VoluntarioHabilidadesController@store');
    Route::put('/{id}', 'VoluntarioHabilidadesController@update');
});

Route::group(['prefix' => 'voluntario'], function () {
    Route::get('/', 'VoluntarioController@index'); // ok
    Route::get('/{id}', 'VoluntarioController@show'); // ok
    Route::post('/', 'VoluntarioController@store'); // ok
    Route::put('/{id}', 'VoluntarioController@update');
});
