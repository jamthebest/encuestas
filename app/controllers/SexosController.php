<?php

class SexosController extends BaseController {

	/**
	 * Sexo Repository
	 *
	 * @var Sexo
	 */
	protected $Sexo;

	public function __construct(Sexo $Sexo)
	{
		$this->Sexo = $Sexo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$Sexos = $this->Sexo->paginate(10);

		return View::make('Sexos.index', compact('Sexos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('Sexos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Sexo::$rules);

		if ($validation->passes())
		{
			$this->Sexo->create($input);

			return Redirect::route('Sexos.index');
		}

		return Redirect::route('Sexos.create')
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
		$Sexo = $this->Sexo->findOrFail($id);

		return View::make('Sexos.show', compact('Sexo'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$Sexo = $this->Sexo->find($id);

		if (is_null($Sexo))
		{
			return Redirect::route('Sexos.index');
		}

		return View::make('Sexos.edit', compact('Sexo'));
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
		$validation = Validator::make($input, Sexo::$rules);

		if ($validation->passes())
		{
			$Sexo = $this->Sexo->find($id);
			$Sexo->update($input);

			return Redirect::route('Sexos.index');
		}

		return Redirect::route('Sexos.edit', $id)
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
		$Sexo = $this->Sexo->find($id);
		$Sexo->activo = 0;
		$Sexo->save();

		return Redirect::route('Sexos.index')->with('message', 'Sexo Desactivado Correctamente');
	}

	public function activar($id)
	{
		$Sexo = $this->Sexo->find($id);
		$Sexo->activo = 1;
		$Sexo->save();

		return Redirect::route('Sexos.index')->with('message', 'Sexo Activado Correctamente');
	}

}
