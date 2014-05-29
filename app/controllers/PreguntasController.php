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
	public function index()
	{
		$preguntas = $this->pregunta->all();

		return View::make('preguntas.index', compact('preguntas'));
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

			return Redirect::route('Encuestas/Preguntas.index');
		}

		return Redirect::route('Encuestas/Preguntas.create')
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

		if (is_null($pregunta))
		{
			return Redirect::route('Encuestas/Preguntas.index');
		}

		return View::make('preguntas.edit', compact('pregunta'));
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

			return Redirect::route('Encuestas/Preguntas.show', $id);
		}

		return Redirect::route('Encuestas/Preguntas.edit', $id)
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

		return Redirect::route('Encuestas/Preguntas.index');
	}

}
