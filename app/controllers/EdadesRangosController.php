<?php

class EdadesRangosController extends BaseController {

	/**
	 * EdadesRango Repository
	 *
	 * @var EdadesRango
	 */
	protected $EdadesRango;

	public function __construct(EdadesRango $EdadesRango)
	{
		$this->EdadesRango = $EdadesRango;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$EdadesRangos = $this->EdadesRango->all();

		return View::make('EdadesRangos.index', compact('EdadesRangos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('EdadesRangos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, EdadesRango::$rules);

		if ($validation->passes())
		{
			$this->EdadesRango->create($input);

			return Redirect::route('EdadesRangos.index');
		}

		return Redirect::route('EdadesRangos.create')
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
		$EdadesRango = $this->EdadesRango->findOrFail($id);

		return View::make('EdadesRangos.show', compact('EdadesRango'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$EdadesRango = $this->EdadesRango->find($id);

		if (is_null($EdadesRango))
		{
			return Redirect::route('EdadesRangos.index');
		}

		return View::make('EdadesRangos.edit', compact('EdadesRango'));
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
		$validation = Validator::make($input, EdadesRango::$rules);

		if ($validation->passes())
		{
			$EdadesRango = $this->EdadesRango->find($id);
			$EdadesRango->update($input);

			return Redirect::route('EdadesRangos.show', $id);
		}

		return Redirect::route('EdadesRangos.edit', $id)
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
		$this->EdadesRango->find($id)->delete();

		return Redirect::route('EdadesRangos.index');
	}

}
