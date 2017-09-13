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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1','middleware' => 'auth:api'], function () {
    //    Route::resource('task', 'TasksController');

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_api_routes
});*/

Route::resource('users', 'api\UserController',['excepto' => 'create,edit']);

Route::get('users/verificar', 'api\UserController@verify');

Route::get('usuario', 'api\UserController@usuario');

Route::resource('info', 'api\InformeMantenimientoPreventivoController',['excepto' => 'create,edit']);


Route::post('oauth/token','\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');


Route::resource('puestos', 'api\PuestoController',['excepto' => 'create']);
Route::resource('puestos.custodios.rel', 'api\PuestoCustodioController');

Route::get('puesto_asigna', 'api\PuestoCustodioController@asigna');
Route::get('puesto_liberar', 'api\PuestoCustodioController@liberar');
Route::resource('custodios', 'api\CustodioController');
Route::get('custodiosCedula', 'api\CustodioController@cedula');

Route::get('custodiosNotificacion', 'api\CustodioController@notificacion');

Route::get('sendNotificacion', 'api\CustodioController@cedula');