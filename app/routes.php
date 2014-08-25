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

Route::get('/Login', array('before' => 'guest', function(){
	return View::make('Login');
}));

//Procesa el formulario e identifica al usuario
Route::post('/Login', array('uses' => 'AuthController@doLogin', 'before' => 'guest'));

//Desconecta al usuario
Route::get('/Logout', array('uses' => 'AuthController@doLogout', 'before' => 'auth'));

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
	Route::get('Mostrar', array('as' => 'Encuestas.todas', 'uses' =>'AdminController@Encuestas', 'before' => 'auth'));
	Route::get('Configurar/{id}', array('as' => 'Configurar', 'uses' =>'AdminController@Configurar', 'before' => 'auth'));
	Route::get('{id}/Configurar', array('as' => 'Configurar.Encuesta', 'uses' =>'EncuestasController@Configurar', 'before' => 'auth'));
	Route::post('Activar/{id}', array('as' => 'Encuestas.activar', 'uses' =>'EncuestasController@activar', 'before' => 'auth'));
	Route::post('Desactivar/{id}', array('as' => 'Encuestas.desactivar', 'uses' =>'EncuestasController@desactivar', 'before' => 'auth'));
	Route::get('Duplicar/{id}', array('as' => 'Encuestas.copiar', 'uses' =>'EncuestasController@copiar', 'before' => 'auth'));
	Route::post('Copia/{id}', array('as' => 'Encuestas.duplicar', 'uses' =>'EncuestasController@duplicar', 'before' => 'auth'));
	Route::get('AsignarPanelistas/{id}', array('as' => 'AsignarPanelistas', 'uses' =>'AdminController@asignar', 'before' => 'auth'));
	Route::post('Search/{id}', array('as' => 'Asignar.Search', 'uses' =>'AdminController@search', 'before' => 'auth'));
	Route::get('VerPanelistas/{id}', array('as' => 'VerPanelistas', 'uses' =>'AdminController@Ver', 'before' => 'auth'));
	Route::post('AsignarPanelistas', array('as' => 'AgregarPanelistas.store', 'uses' =>'AdminController@store', 'before' => 'auth'));
	Route::get('Index/{id}', array('as' => 'Pagos.Index', 'uses' =>'PagosController@index'));
	Route::get('Pagos/{id}', array('as' => 'CrearPagos', 'uses' =>'PagosController@create', 'before' => 'auth'));
	Route::post('FinPagos/{id}', array('as' => 'Fin.Pagos', 'uses' =>'PagosController@finalizar', 'before' => 'auth'));
	Route::post('Promopuntos/{id}', array('as' => 'Promopuntos', 'uses' =>'AdminController@Promopuntos', 'before' => 'auth'));
	Route::resource('Preguntas', 'PreguntasController');
	Route::resource('Respuestas', 'RespuestasController');
	Route::resource('Pagos', 'PagosController');

	Route::get('{id}/Requerimientos', array('as' => 'Requerimientos', 'uses' =>'UsuariosController@requerimientos', 'before' => 'auth'));

	Route::get('{id}/RequerimientoCiudad', array('as' => 'RequerimientoCiudad.nuevo', 'uses' =>'RequerimientoCiudadsController@nuevo', 'before' => 'auth'));
	Route::get('{id}/RequerimientoEdad', array('as' => 'RequerimientoEdad.nuevo', 'uses' =>'RequerimientoEdadsController@nuevo', 'before' => 'auth'));
	Route::get('{id}/RequerimientoNse', array('as' => 'RequerimientoNse.nuevo', 'uses' =>'RequerimientoNsesController@nuevo', 'before' => 'auth'));
	Route::get('{id}/RequerimientoSexo', array('as' => 'RequerimientoSexo.nuevo', 'uses' =>'RequerimientoSexosController@nuevo', 'before' => 'auth'));

});

Route::get('Configuracion', array('as' => 'Configuracion', 'uses' =>'AdminController@Configuracion', 'before' => 'auth'));

Route::resource('Encuestas', 'EncuestasController');
Route::resource('Usuarios', 'UsuariosController');

Route::get('Contestar/{id}', array('as' => 'Contestar', 'uses' =>'PanelistasController@show', 'before' => 'auth'));
Route::get('ContestarEncuesta/{id}', array('as' => 'Bienvenida', 'uses' =>'PanelistasController@bienvenida', 'before' => 'auth'));
Route::get('EncuestaContestada/{id}', array('as' => 'Despedida', 'uses' =>'PanelistasController@despedida', 'before' => 'auth'));
Route::get('MisEncuestas', array('as' => 'MisEncuestas', 'uses' =>'PanelistasController@index', 'before' => 'auth'));
Route::post('Contestar/{id}', array('as' => 'Respuestas.store', 'uses' =>'RespuestasController@store', 'before' => 'auth'));

Route::get('Resultados', array('as' => 'Resultados', 'uses' =>'EncuestasController@resultados', 'before' => 'auth'));
Route::get('VerResultados', array('as' => 'Resultados.todos', 'uses' =>'AdminController@resultados', 'before' => 'auth'));
Route::get('Resultados/{id}', array('as' => 'Encuestas.Resultado', 'uses' =>'EncuestasController@resultado', 'before' => 'auth'));
Route::get('VerResultados/{id}', array('as' => 'Admin.Resultado', 'uses' =>'AdminController@resultado', 'before' => 'auth'));

Route::resource('Precios', 'PreciosController');
Route::post('Precios/Activar/{id}', array('as' => 'Precios.activar', 'uses' =>'PreciosController@activar', 'before' => 'auth'));

Route::resource('Ciudades', 'CiudadesController');
Route::post('Ciudades/Activar/{id}', array('as' => 'Ciudades.activar', 'uses' =>'CiudadesController@activar', 'before' => 'auth'));

Route::resource('NivelSocioEconomicos', 'NivelSocioEconomicosController');
Route::post('NSE/Activar/{id}', array('as' => 'NivelSocioEconomicos.activar', 'uses' =>'NivelSocioEconomicosController@activar', 'before' => 'auth'));

Route::resource('EdadesRangos', 'EdadesRangosController');
Route::post('EdadRango/Activar/{id}', array('as' => 'EdadesRangos.activar', 'uses' =>'EdadesRangosController@activar', 'before' => 'auth'));

Route::resource('Sexos', 'SexosController');
Route::post('Sexo/Activar/{id}', array('as' => 'Sexos.activar', 'uses' =>'SexosController@activar', 'before' => 'auth'));

Route::resource('RequerimientoCiudad', 'RequerimientoCiudadsController');
	
Route::resource('RequerimientoEdad', 'RequerimientoEdadsController');

Route::resource('RequerimientoNse', 'RequerimientoNsesController');

Route::resource('RequerimientoSexo', 'RequerimientoSexosController');