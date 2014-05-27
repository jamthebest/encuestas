<?php

Route::get('/', function()
{
	return View::make('Inicio');
});

Route::get('Inicio', function()
{
	return View::make('Inicio');
});

Route::get('/Login', ['before' => 'guest', function(){
	return View::make('Login');
}]);

//Procesa el formulario e identifica al usuario
Route::post('/Login', ['uses' => 'AuthController@doLogin', 'before' => 'guest']);

//Desconecta al usuario
Route::get('/Logout', ['uses' => 'AuthController@doLogout', 'before' => 'auth']);

