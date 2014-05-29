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

Route::get('Registro', array('as' => 'Registro', 'uses' =>'UsuariosController@create', 'before' => 'guest'));

Route::post('Registro', array('as' => 'Registrar', 'uses' =>'UsuariosController@store', 'before' => 'guest'));

Route::group(array('prefix' => 'Encuestas'), function(){
	Route::group(array('prefix' => 'Preguntas'), function(){
		Route::get('Agregar/{id}', array('as' => 'Encuestas.Preguntas.Agregar', 'uses' =>'PreguntasController@Agregar'));
		Route::get('Index/{id}', array('as' => 'Encuestas.Preguntas.Index', 'uses' =>'PreguntasController@index'));
		Route::resource('Tipos', 'TiposController');
		Route::resource('Opciones', 'OpcionesController');
	});
	Route::resource('Preguntas', 'PreguntasController');
	Route::resource('Respuestas', 'RespuestasController');
	Route::resource('Pagos', 'PagosController');
});

Route::resource('Encuestas', 'EncuestasController');