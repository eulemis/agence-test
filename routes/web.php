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

/* Route::get('/', function () {
    return view('auth/login');
}); */
Route::get('/', function () {
    return view('home');
});
Route::post('login', 'LoginController@login')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/', 'HomeController@index')->name('home');



Route::get('/agence', 'AgenceController@index')->name('agence');
Route::get('/administrativo', 'AdministrativoController@index')->name('administrativo');
Route::get('/getGraficoConsultores/', 'AdministrativoController@getGraficoConsultores')->name('getGraficoConsultores');
Route::get('/getConsultores/', 'AdministrativoController@getConsultores')->name('getConsultores');
Route::get('/getRelatorio/', 'AdministrativoController@getRelatorio')->name('getRelatorio');

Route::get('/comercial', 'ComercialController@index')->name('comercial');
Route::get('/financeiro', 'FinanceiroController@index')->name('financeiro');
Route::get('/usuario', 'UsuarioController@index')->name('usuario');
Route::get('/projecto', 'ProjectoController@index')->name('projecto');
