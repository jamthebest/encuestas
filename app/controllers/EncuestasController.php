<?php

class EncuestasController extends BaseController {

	/**
	 * Encuesta Repository
	 *
	 * @var Encuesta
	 */
	protected $encuesta;

	public function __construct(Encuesta $encuesta)
	{
		$this->encuesta = $encuesta;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Auth::check()) {
			if (Auth::user()->tipo != 'panelista' ) {
				$encuestas = $this->encuesta->where('usuario', Auth::user()->id)->where('activa', 1)->paginate(10);
				return View::make('Encuestas.index', compact('encuestas'));
			}
			return Redirect::to('Inicio')->with('message','Permiso Denegado!');
		}
		return Redirect::to('Login')->with('message','Debe Autenticarse Primero!');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('Encuestas.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Encuesta::$rules);
		
		if ($validation->passes())
		{
			$this->encuesta->create($input);
			$encuesta = Encuesta::where('id', '<>', '0')->orderBy('id', 'DESC')->get();
			$id = $encuesta[0]->id;
			return Redirect::route('Encuestas.Preguntas.Agregar', $id);
		}

		return Redirect::route('Encuestas.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		if (!Auth::check()) {
			return Redirect::to('Login')->with('message','Debe Autenticarse Primero!');
		}else if(Auth::user()->tipo == 'panelista'){
			return Redirect::to('Inicio')->with('message','Permiso Denegado!');
		}

		$encuesta = $this->encuesta->findOrFail($id);

		return View::make('Encuestas.show', compact('encuesta'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if (!Auth::check()) {
			return Redirect::to('Login')->with('message','Debe Autenticarse Primero!');
		}else if(Auth::user()->tipo == 'panelista'){
			return Redirect::to('Inicio')->with('message','Permiso Denegado!');
		}

		$encuesta = $this->encuesta->find($id);

		if (is_null($encuesta))
		{
			return Redirect::route('Encuestas.index')
					->withErrors('No se encontró esa encuesta');
		}

		return View::make('Encuestas.edit', compact('encuesta'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Encuesta::$rules);

		if ($validation->passes())
		{
			$encuesta = $this->encuesta->find($id);
			$encuesta->update($input);

			return Redirect::route('Encuestas.index');
		}

		return Redirect::route('Encuestas.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if (!Auth::check()) {
			return Redirect::to('Login')->with('message','Debe Autenticarse Primero!');
		}else if(Auth::user()->tipo == 'panelista'){
			return Redirect::to('Inicio')->with('message','Permiso Denegado!');
		}

		$encuesta = $this->encuesta->find($id);
		$encuesta->activa = 0;
		$encuesta->save();

		return Redirect::route('Encuestas.index')->with('message', 'Encuesta Eliminada!');
	}

	public function activar($id)
	{
		if (!Auth::check()) {
			return Redirect::to('Login')->with('message','Debe Autenticarse Primero!');
		}else if(Auth::user()->tipo == 'panelista'){
			return Redirect::to('Inicio')->with('message','Permiso Denegado!');
		}

		$encuesta = $this->encuesta->find($id);
		$encuesta->activa = 1;
		$encuesta->save();

		return Redirect::route('Configurar', $id)->with('message', 'Encuesta Activada!');
	}

	public function desactivar($id)
	{
		if (!Auth::check()) {
			return Redirect::to('Login')->with('message','Debe Autenticarse Primero!');
		}else if(Auth::user()->tipo == 'panelista'){
			return Redirect::to('Inicio')->with('message','Permiso Denegado!');
		}

		$encuesta = $this->encuesta->find($id);
		$encuesta->activa = 0;
		$encuesta->save();

		return Redirect::route('Configurar', $id)->with('message', 'Encuesta Desactivada!');
	}

	public function resultados()
	{
		if (!Auth::check()) {
			return Redirect::to('Login')->with('message','Debe Autenticarse Primero!');
		}else if(Auth::user()->tipo == 'panelista'){
			return Redirect::to('Inicio')->with('message','Permiso Denegado!');
		}

		$encuestas = $this->encuesta->where('usuario', Auth::user()->id)->where('activa', 1)->paginate(10);
		return View::make('Encuestas.resultados', compact('encuestas'));
	}

	public function resultado($id)
	{
		if (Auth::check()) {
			$encuesta = $this->encuesta->find($id);
			if ($encuesta) {
				if ($encuesta->usuario == Auth::user()->id) {
					$preguntas = Pregunta::where('encuesta', $id)->get();
					if ($preguntas) {
						$preg = $preguntas->lists('id');
						$opciones = Opcion::whereIn('pregunta', $preg)->get();
						if ($opciones) {
							$resultados = array();
							$texto = array();
							$num = 0;
							$cont = 0;
							foreach ($opciones as $opcion) {
								$respuestas = Respuesta::where('opcion', $opcion->id)->get();
								$resultados[$opcion->id] = 0;
								if ($opcion->descripcion != 'Texto') {
									foreach ($respuestas as $respuesta) {
										if ($num == 0) {
											$num = $opcion->id;
										}
										if ($num == $opcion->id) {
											$cont += 1;
										}
										if ($respuesta->descripcion == $opcion->descripcion) {
											$resultados[$opcion->id] += 1;
										}
									}
								}else{
									$tam = sizeof($texto);
									$texto[$opcion->id] = "";
									foreach ($respuestas as $respuesta) {
										if ($num == 0) {
											$num = $opcion->id;
										}
										if ($num == $opcion->id) {
											$cont += 1;
										}
										$texto[$opcion->id] .= ($tam == 0 ? "" : ", ") . $respuesta->descripcion . "\n";
										$tam = sizeof($texto);
									}
								}
							}
							return View::make('Encuestas.resultado', compact('resultados', 'texto', 'preguntas', 'opciones', 'encuesta', 'cont'));
						}
					}
					return Redirect::route('Resultados')->with('message', 'La Encuesta no tiene Preguntas');
				}
			}
			return Redirect::route('Resultados')->with('message', 'Permiso Denegado!');
		}
		return Redirect::to('Login')->with('message','Debe Autenticarse Primero!');
	}

}
