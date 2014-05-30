<?php

class PreguntasController extends BaseController {

	/**
	 * Pregunta Repository
	 *
	 * @var Pregunta
	 */
	protected $pregunta;

	public function __construct(Pregunta $pregunta)
	{
		$this->pregunta = $pregunta;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		$preguntas = Pregunta::where('encuesta', $id)->get();
		$tipos = Tipo::all();
		$encuesta = Encuesta::find($id)->nombre;
		$cont = 1;
		return View::make('preguntas.index', compact('preguntas', 'tipos', 'encuesta', 'cont', 'id'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('preguntas.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Pregunta::$rules);

		if ($validation->passes())
		{
			$this->pregunta->create($input);
			$pregunta = Pregunta::where('id', '<>', '0')->orderBy('id', 'DESC')->get();
			$id = $pregunta[0]->id;

			if ($input['tipo'] == 1) {
				$opcion['descripcion'] = 'Texto';
				$opcion['pregunta'] = $id;
				Opcion::create($opcion);
				return Redirect::route('Encuestas.Preguntas.Index', $input['encuesta']);
			}
			return Redirect::route('Encuestas.Preguntas.Opciones.Agregar', $id);
		}

		return Redirect::route('Encuestas.Preguntas.Agregar', $input['encuesta'])
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
		$pregunta = $this->pregunta->findOrFail($id);

		return View::make('preguntas.show', compact('pregunta'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$pregunta = $this->pregunta->find($id);
		$tipos = Tipo::all()->lists('nombre', 'id', 'descripcion');
		if (is_null($pregunta))
		{
			return Redirect::route('Encuestas.index')
				->withErrors('No se encontró esa pregunta!');
		}

		$Encuesta = Encuesta::find($pregunta->encuesta);
		return View::make('preguntas.edit', compact('pregunta', 'Encuesta', 'tipos'));
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
		$validation = Validator::make($input, Pregunta::$rules);

		if ($validation->passes())
		{
			$pregunta = $this->pregunta->find($id);
			$pregunta->update($input);

			return Redirect::route('Encuestas.Preguntas.Index', $id);
		}

		return Redirect::route('Encuestas.Preguntas.edit', $id)
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
		$this->pregunta->find($id)->delete();

		return Redirect::route('Encuestas.Preguntas.index');
	}


	public function Agregar($id)
	{
		$Encuesta = Encuesta::find($id);
		$tipos = Tipo::all()->lists('nombre', 'id', 'descripcion');
		return View::make('preguntas.create', compact('Encuesta', 'tipos'));
	}

}
