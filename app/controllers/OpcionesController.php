<?php

class OpcionesController extends BaseController {

	/**
	 * Opcion Repository
	 *
	 * @var Opcion
	 */
	protected $opcion;

	public function __construct(Opcion $opcion)
	{
		$this->opcion = $opcion;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		if (Auth::check()) {
			if (Auth::user()->tipo != 'panelista') {
				$opciones = Opcion::where('pregunta', $id)->paginate(10);
				$pregunta = Pregunta::find($id);
				if (!$pregunta) {
					return Redirect::route('Encuestas.index')->with('message','Permiso Denegado!');
				}
				$encuesta = Encuesta::find($pregunta->encuesta);
				if ($encuesta) {
					if ($encuesta->activa == 0) {
						return Redirect::route('Encuestas.index')->with('message','Encuesta Desactivada!');
					}
				}
				$tipos = Tipo::all();
				$cont = 1;
				return View::make('opciones.index', compact('opciones', 'pregunta', 'encuesta', 'tipos', 'cont', 'id'));
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
		return View::make('opciones.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Opcion::$rules);

		if ($validation->passes())
		{
			$this->opcion->create($input);
			$opcion = Opcion::where('id', '<>', '0')->orderBy('id', 'DESC')->get();
			$id = $opcion[0]->pregunta;
			
			return Redirect::route('Encuestas.Preguntas.Opciones.Index', $id);
		}

		return Redirect::route('Encuestas.Preguntas.Opciones.Agregar', $input['pregunta'])
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
		$opcion = $this->opcion->findOrFail($id);

		return View::make('opciones.show', compact('opcion'));
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

		$opcion = $this->opcion->find($id);

		if (is_null($opcion))
		{
			return Redirect::route('Encuestas.index')
				->withErrors('No se encontró esa opción!');
		}

		return View::make('opciones.edit', compact('opcion'));
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
		$validation = Validator::make($input, Opcion::$rules);

		if ($validation->passes())
		{
			$opcion = $this->opcion->find($id);
			$opcion->update($input);

			return Redirect::route('Encuestas.Preguntas.Opciones.Index', $input['pregunta']);
		}

		return Redirect::route('Encuestas.Preguntas.Opciones.edit', $id)
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

		$this->opcion->find($id)->delete();

		return Redirect::route('Encuestas.Preguntas.Opciones.index');
	}


	public function Agregar($id)
	{
		if (!Auth::check()) {
			return Redirect::to('Login')->with('message','Debe Autenticarse Primero!');
		}else if(Auth::user()->tipo == 'panelista'){
			return Redirect::to('Inicio')->with('message','Permiso Denegado!');
		}
		
		$Pregunta = Pregunta::find($id);
		$Encuesta = Encuesta::find($Pregunta->encuesta);
		
		return View::make('opciones.create', compact('Pregunta', 'Encuesta'));
	}

}
