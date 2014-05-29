<?php

class OpcionesController extends BaseController {

	/**
	 * Opcione Repository
	 *
	 * @var Opcione
	 */
	protected $opcione;

	public function __construct(Opcione $opcione)
	{
		$this->opcione = $opcione;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$opciones = $this->opcione->all();

		return View::make('opciones.index', compact('opciones'));
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
		$validation = Validator::make($input, Opcione::$rules);

		if ($validation->passes())
		{
			$this->opcione->create($input);

			return Redirect::route('Encuestas/Preguntas/Opciones.index');
		}

		return Redirect::route('Encuestas/Preguntas/Opciones.create')
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
		$opcione = $this->opcione->findOrFail($id);

		return View::make('opciones.show', compact('opcione'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$opcione = $this->opcione->find($id);

		if (is_null($opcione))
		{
			return Redirect::route('Encuestas/Preguntas/Opciones.index');
		}

		return View::make('opciones.edit', compact('opcione'));
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
		$validation = Validator::make($input, Opcione::$rules);

		if ($validation->passes())
		{
			$opcione = $this->opcione->find($id);
			$opcione->update($input);

			return Redirect::route('Encuestas/Preguntas/Opciones.show', $id);
		}

		return Redirect::route('Encuestas/Preguntas/Opciones.edit', $id)
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
		$this->opcione->find($id)->delete();

		return Redirect::route('Encuestas/Preguntas/Opciones.index');
	}

}
