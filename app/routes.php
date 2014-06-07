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

Route::get('Encuestas/Preguntas', function()
{
	return Redirect::route('Encuestas.index');
});

Route::get('Encuestas/Preguntas/Opciones', function()
{
	return Redirect::route('Encuestas.index');
});

Route::group(array('prefix' => 'Encuestas', 'before' => 'auth'), function(){
	Route::group(array('prefix' => 'Preguntas'), function(){
		Route::get('Agregar/{id}', array('as' => 'Encuestas.Preguntas.Agregar', 'uses' =>'PreguntasController@Agregar'));
		Route::get('Index/{id}', array('as' => 'Encuestas.Preguntas.Index', 'uses' =>'PreguntasController@index'));
		Route::resource('Tipos', 'TiposController');
		Route::resource('Opciones', 'OpcionesController');
		Route::get('Opciones/Agregar/{id}', array('as' => 'Encuestas.Preguntas.Opciones.Agregar', 'uses' =>'OpcionesController@Agregar'));
		Route::get('Opciones/Index/{id}', array('as' => 'Encuestas.Preguntas.Opciones.Index', 'uses' =>'OpcionesController@index'));
	});
	Route::get('Mostrar', ['as' => 'Encuestas.todas', 'uses' =>'AdminController@Encuestas', 'before' => 'auth']);
	Route::get('AsignarPanelistas/{id}', ['as' => 'AsignarPanelistas', 'uses' =>'AdminController@asignar', 'before' => 'auth']);
	Route::get('VerPanelistas/{id}', ['as' => 'VerPanelistas', 'uses' =>'AdminController@Ver', 'before' => 'auth']);
	Route::post('AsignarPanelistas', ['as' => 'AgregarPanelistas.store', 'uses' =>'AdminController@store', 'before' => 'auth']);
	Route::resource('Preguntas', 'PreguntasController');
	Route::resource('Respuestas', 'RespuestasController');
	Route::resource('Pagos', 'PagosController');
});

Route::resource('Encuestas', 'EncuestasController');
Route::resource('Usuarios', 'UsuariosController');

Route::get('Contestar/{id}', ['as' => 'Contestar', 'uses' =>'PanelistasController@show', 'before' => 'auth']);
Route::get('MisEncuestas', ['as' => 'MisEncuestas', 'uses' =>'PanelistasController@index', 'before' => 'auth']);