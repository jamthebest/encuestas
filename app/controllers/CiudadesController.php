<?php

class CiudadesController extends BaseController {

	/**
	 * Ciudad Repository
	 *
	 * @var Ciudad
	 */
	protected $Ciudad;

	public function __construct(Ciudad $Ciudad)
	{
		$this->Ciudad = $Ciudad;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$Ciudades = $this->Ciudad->all();

		return View::make('Ciudades.index', compact('Ciudades'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('Ciudades.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Ciudad::$rules);

		if ($validation->passes())
		{
			$this->Ciudad->create($input);

			return Redirect::route('Ciudades.index');
		}

		return Redirect::route('Ciudades.create')
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
		$Ciudad = $this->Ciudad->findOrFail($id);

		return View::make('Ciudades.show', compact('Ciudad'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$Ciudad = $this->Ciudad->find($id);

		if (is_null($Ciudad))
		{
			return Redirect::route('Ciudades.index');
		}

		return View::make('Ciudades.edit', compact('Ciudad'));
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
		$validation = Validator::make($input, Ciudad::$rules);

		if ($validation->passes())
		{
			$Ciudad = $this->Ciudad->find($id);
			$Ciudad->update($input);

			return Redirect::route('Ciudades.show', $id);
		}

		return Redirect::route('Ciudades.edit', $id)
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
		$this->Ciudad->find($id)->delete();

		return Redirect::route('Ciudades.index');
	}

}
