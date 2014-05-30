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
		$encuestas = $this->encuesta->all();

		return View::make('Encuestas.index', compact('encuestas'));
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
		$encuesta = $this->encuesta->find($id);

		if (is_null($encuesta))
		{
			return Redirect::route('Encuestas.index');
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
		$this->encuesta->find($id)->delete();

		return Redirect::route('Encuestas.index');
	}

}
