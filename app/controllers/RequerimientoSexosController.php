<?php

class RequerimientoSexosController extends BaseController {

	/**
	 * RequerimientoSexo Repository
	 *
	 * @var RequerimientoSexo
	 */
	protected $RequerimientoSexo;

	public function __construct(RequerimientoSexo $RequerimientoSexo)
	{
		$this->RequerimientoSexo = $RequerimientoSexo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$RequerimientoSexos = $this->RequerimientoSexo->all();

		return View::make('RequerimientoSexos.index', compact('RequerimientoSexos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('RequerimientoSexos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, RequerimientoSexo::$rules);

		if ($validation->passes())
		{
			$this->RequerimientoSexo->create($input);

			return Redirect::route('Requerimientos', $input['encuesta']);
		}

		return Redirect::route('RequerimientoSexo.nuevo', $input['encuesta'])
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
		$RequerimientoSexo = $this->RequerimientoSexo->findOrFail($id);

		return View::make('RequerimientoSexos.show', compact('RequerimientoSexo'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$RequerimientoSexo = $this->RequerimientoSexo->find($id);

		if (is_null($RequerimientoSexo))
		{
			return Redirect::route('RequerimientoSexo.index');
		}

		return View::make('RequerimientoSexos.edit', compact('RequerimientoSexo'));
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
		$validation = Validator::make($input, RequerimientoSexo::$rules);

		if ($validation->passes())
		{
			$RequerimientoSexo = $this->RequerimientoSexo->find($id);
			$RequerimientoSexo->update($input);

			return Redirect::route('RequerimientoSexo.show', $id);
		}

		return Redirect::route('RequerimientoSexo.edit', $id)
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
		$encuesta = $this->RequerimientoSexo->find($id)->encuesta;
		$this->RequerimientoSexo->find($id)->delete();

		return Redirect::route('Requerimientos', $encuesta);
	}

	public function nuevo($id)
	{
		$req = RequerimientoSexo::where('encuesta', $id)->lists('sexo');
		if ($req) {
			$Sexo = Sexo::whereNotIn('id', $req)->where('activo', '1')->lists('nombre', 'id');
		}else{
			$Sexo = Sexo::where('activo', '1')->lists('nombre', 'id');
		}
		return View::make('RequerimientoSexos.create', compact('id', 'Sexo'));
	}

}
