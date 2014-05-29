<?php

class RespuestasController extends BaseController {

	/**
	 * Respuesta Repository
	 *
	 * @var Respuesta
	 */
	protected $respuesta;

	public function __construct(Respuesta $respuesta)
	{
		$this->respuesta = $respuesta;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$respuestas = $this->respuesta->all();

		return View::make('respuestas.index', compact('respuestas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('respuestas.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Respuesta::$rules);

		if ($validation->passes())
		{
			$this->respuesta->create($input);

			return Redirect::route('Encuestas/Respuestas.index');
		}

		return Redirect::route('Encuestas/Respuestas.create')
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
		$respuesta = $this->respuesta->findOrFail($id);

		return View::make('respuestas.show', compact('respuesta'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$respuesta = $this->respuesta->find($id);

		if (is_null($respuesta))
		{
			return Redirect::route('Encuestas/Respuestas.index');
		}

		return View::make('respuestas.edit', compact('respuesta'));
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
		$validation = Validator::make($input, Respuesta::$rules);

		if ($validation->passes())
		{
			$respuesta = $this->respuesta->find($id);
			$respuesta->update($input);

			return Redirect::route('Encuestas/Respuestas.show', $id);
		}

		return Redirect::route('Encuestas/Respuestas.edit', $id)
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
		$this->respuesta->find($id)->delete();

		return Redirect::route('Encuestas/Respuestas.index');
	}

}
