<?php

Route::get('/', function()
{
	return View::make('Inicio');
});

Route::get('Inicio', function()
{
	return View::make('Inicio');
});

Route::get('Informacion', function()
{
	return View::make('Informacion');
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
	Route::get('Configurar/{id}', ['as' => 'Configurar', 'uses' =>'AdminController@Configurar', 'before' => 'auth']);
	Route::post('Activar/{id}', ['as' => 'Encuestas.activar', 'uses' =>'EncuestasController@activar', 'before' => 'auth']);
	Route::post('Desactivar/{id}', ['as' => 'Encuestas.desactivar', 'uses' =>'EncuestasController@desactivar', 'before' => 'auth']);
	Route::get('Duplicar/{id}', ['as' => 'Encuestas.copiar', 'uses' =>'EncuestasController@copiar', 'before' => 'auth']);
	Route::post('Copia/{id}', ['as' => 'Encuestas.duplicar', 'uses' =>'EncuestasController@duplicar', 'before' => 'auth']);
	Route::get('AsignarPanelistas/{id}', ['as' => 'AsignarPanelistas', 'uses' =>'AdminController@asignar', 'before' => 'auth']);
	Route::post('Search/{id}', ['as' => 'Asignar.Search', 'uses' =>'AdminController@search', 'before' => 'auth']);
	Route::get('VerPanelistas/{id}', ['as' => 'VerPanelistas', 'uses' =>'AdminController@Ver', 'before' => 'auth']);
	Route::post('AsignarPanelistas', ['as' => 'AgregarPanelistas.store', 'uses' =>'AdminController@store', 'before' => 'auth']);
	Route::get('Index/{id}', array('as' => 'Pagos.Index', 'uses' =>'PagosController@index'));
	Route::get('Pagos/{id}', ['as' => 'CrearPagos', 'uses' =>'PagosController@create', 'before' => 'auth']);
	Route::post('FinPagos/{id}', ['as' => 'Fin.Pagos', 'uses' =>'PagosController@finalizar', 'before' => 'auth']);
	Route::post('Promopuntos/{id}', ['as' => 'Promopuntos', 'uses' =>'AdminController@Promopuntos', 'before' => 'auth']);
	Route::resource('Preguntas', 'PreguntasController');
	Route::resource('Respuestas', 'RespuestasController');
	Route::resource('Pagos', 'PagosController');

	Route::get('{id}/Requerimientos', ['as' => 'Requerimientos', 'uses' =>'UsuariosController@requerimientos', 'before' => 'auth']);

	Route::get('{id}/RequerimientoCiudad', ['as' => 'RequerimientoCiudad.nuevo', 'uses' =>'RequerimientociudadsController@nuevo', 'before' => 'auth']);
	Route::get('{id}/RequerimientoEdad', ['as' => 'RequerimientoEdad.nuevo', 'uses' =>'RequerimientoedadsController@nuevo', 'before' => 'auth']);
	Route::get('{id}/RequerimientoNse', ['as' => 'RequerimientoNse.nuevo', 'uses' =>'RequerimientonsesController@nuevo', 'before' => 'auth']);
	Route::get('{id}/RequerimientoSexo', ['as' => 'RequerimientoSexo.nuevo', 'uses' =>'RequerimientosexosController@nuevo', 'before' => 'auth']);

});

Route::resource('Encuestas', 'EncuestasController');
Route::resource('Usuarios', 'UsuariosController');

Route::get('Contestar/{id}', ['as' => 'Contestar', 'uses' =>'PanelistasController@show', 'before' => 'auth']);
Route::get('ContestarEncuesta/{id}', ['as' => 'Bienvenida', 'uses' =>'PanelistasController@bienvenida', 'before' => 'auth']);
Route::get('EncuestaContestada/{id}', ['as' => 'Despedida', 'uses' =>'PanelistasController@despedida', 'before' => 'auth']);
Route::get('MisEncuestas', ['as' => 'MisEncuestas', 'uses' =>'PanelistasController@index', 'before' => 'auth']);
Route::post('Contestar/{id}', ['as' => 'Respuestas.store', 'uses' =>'RespuestasController@store', 'before' => 'auth']);

Route::get('Resultados', ['as' => 'Resultados', 'uses' =>'EncuestasController@resultados', 'before' => 'auth']);
Route::get('VerResultados', ['as' => 'Resultados.todos', 'uses' =>'AdminController@resultados', 'before' => 'auth']);
Route::get('Resultados/{id}', ['as' => 'Encuestas.Resultado', 'uses' =>'EncuestasController@resultado', 'before' => 'auth']);
Route::get('VerResultados/{id}', ['as' => 'Admin.Resultado', 'uses' =>'AdminController@resultado', 'before' => 'auth']);

Route::resource('Precios', 'PreciosController');

Route::resource('Ciudades', 'CiudadesController');

Route::resource('NivelSocioEconomicos', 'NivelSocioEconomicosController');

Route::resource('EdadesRangos', 'EdadesrangosController');

Route::resource('RequerimientoCiudad', 'RequerimientociudadsController');
	
Route::resource('RequerimientoEdad', 'RequerimientoedadsController');

Route::resource('RequerimientoNse', 'RequerimientonsesController');

Route::resource('RequerimientoSexo', 'RequerimientosexosController');

Route::resource('sexos', 'SexosController');