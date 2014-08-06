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

			return Redirect::route('RequerimientoEdads.index');
		}

		return Redirect::route('RequerimientoEdads.create')
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
			return Redirect::route('RequerimientoEdads.index');
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

			return Redirect::route('RequerimientoEdads.show', $id);
		}

		return Redirect::route('RequerimientoEdads.edit', $id)
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
		$this->RequerimientoEdad->find($id)->delete();

		return Redirect::route('RequerimientoEdads.index');
	}

}
