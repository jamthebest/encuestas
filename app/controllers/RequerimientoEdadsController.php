<?php

class RequerimientoEdadsController extends BaseController {

	/**
	 * RequerimientoEdad Repository
	 *
	 * @var RequerimientoEdad
	 */
	protected $RequerimientoEdad;

	public function __construct(RequerimientoEdad $RequerimientoEdad)
	{
		$this->RequerimientoEdad = $RequerimientoEdad;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$RequerimientoEdads = $this->RequerimientoEdad->all();

		return View::make('RequerimientoEdads.index', compact('RequerimientoEdads'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('RequerimientoEdads.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, RequerimientoEdad::$rules);

		if ($validation->passes())
		{
			$this->RequerimientoEdad->create($input);

			return Redirect::route('Requerimientos', $input['encuesta']);
		}

		return Redirect::route('RequerimientoEdad.nuevo', $input['encuesta'])
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
		$RequerimientoEdad = $this->RequerimientoEdad->findOrFail($id);

		return View::make('RequerimientoEdads.show', compact('RequerimientoEdad'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$RequerimientoEdad = $this->RequerimientoEdad->find($id);

		if (is_null($RequerimientoEdad))
		{
			return Redirect::route('RequerimientoEdad.index');
		}

		return View::make('RequerimientoEdads.edit', compact('RequerimientoEdad'));
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
		$validation = Validator::make($input, RequerimientoEdad::$rules);

		if ($validation->passes())
		{
			$RequerimientoEdad = $this->RequerimientoEdad->find($id);
			$RequerimientoEdad->update($input);

			return Redirect::route('RequerimientoEdad.show', $id);
		}

		return Redirect::route('RequerimientoEdad.edit', $id)
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
		$encuesta = $this->RequerimientoEdad->find($id)->encuesta;
		$this->RequerimientoEdad->find($id)->delete();

		return Redirect::route('Requerimientos', $encuesta);
	}

	public function nuevo($id)
	{
		$req = RequerimientoEdad::where('encuesta', $id)->lists('rango');
		if ($req) {
			$Edad = EdadesRango::whereNotIn('id', $req)->where('activo', '1')->get();
		}else{
			$Edad = EdadesRango::where('activo', '1')->get();
		}
		$Rango = array();
		foreach ($Edad as $edad) {
			$Rango = $Rango + array($edad->id => $edad->edad_inicio . " Años - " . $edad->edad_final . " Años");
		}
		return View::make('RequerimientoEdads.create', compact('id', 'Edad', 'Rango'));
	}

}
