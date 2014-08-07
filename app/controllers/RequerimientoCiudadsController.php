<?php

class RequerimientoCiudadsController extends BaseController {

	/**
	 * RequerimientoCiudad Repository
	 *
	 * @var RequerimientoCiudad
	 */
	protected $RequerimientoCiudad;

	public function __construct(RequerimientoCiudad $RequerimientoCiudad)
	{
		$this->RequerimientoCiudad = $RequerimientoCiudad;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$RequerimientoCiudads = $this->RequerimientoCiudad->all();

		return View::make('RequerimientoCiudads.index', compact('RequerimientoCiudads'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('RequerimientoCiudads.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, RequerimientoCiudad::$rules);

		if ($validation->passes())
		{
			$this->RequerimientoCiudad->create($input);

			return Redirect::route('Requerimientos', $input['encuesta']);
		}

		return Redirect::route('RequerimientoCiudad.nuevo', $input['encuesta'])
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
		$RequerimientoCiudad = $this->RequerimientoCiudad->findOrFail($id);

		return View::make('RequerimientoCiudads.show', compact('RequerimientoCiudad'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$RequerimientoCiudad = $this->RequerimientoCiudad->find($id);

		if (is_null($RequerimientoCiudad))
		{
			return Redirect::route('RequerimientoCiudads.index');
		}

		return View::make('RequerimientoCiudads.edit', compact('RequerimientoCiudad'));
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
		$validation = Validator::make($input, RequerimientoCiudad::$rules);

		if ($validation->passes())
		{
			$RequerimientoCiudad = $this->RequerimientoCiudad->find($id);
			$RequerimientoCiudad->update($input);

			return Redirect::route('RequerimientoCiudads.show', $id);
		}

		return Redirect::route('RequerimientoCiudads.edit', $id)
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
		$encuesta = $this->RequerimientoCiudad->find($id)->encuesta;
		$this->RequerimientoCiudad->find($id)->delete();

		return Redirect::route('Requerimientos', $encuesta);
	}

	public function nuevo($id)
	{
		$req = RequerimientoCiudad::where('encuesta', $id)->lists('ciudad');
		if ($req) {
			$Ciudades = Ciudad::whereNotIn('id', $req)->where('activo', '1')->lists('nombre', 'id');
		}else{
			$Ciudades = Ciudad::where('activo', '1')->lists('nombre', 'id');
		}
		return View::make('RequerimientoCiudads.create', compact('id', 'Ciudades'));
	}

}
