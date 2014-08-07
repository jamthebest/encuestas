<?php

class RequerimientoNsesController extends BaseController {

	/**
	 * RequerimientoNse Repository
	 *
	 * @var RequerimientoNse
	 */
	protected $RequerimientoNse;

	public function __construct(RequerimientoNse $RequerimientoNse)
	{
		$this->RequerimientoNse = $RequerimientoNse;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$RequerimientoNses = $this->RequerimientoNse->all();

		return View::make('RequerimientoNses.index', compact('RequerimientoNses'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('RequerimientoNses.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, RequerimientoNse::$rules);

		if ($validation->passes())
		{
			$this->RequerimientoNse->create($input);

			return Redirect::route('Requerimientos', $input['encuesta']);
		}

		return Redirect::route('RequerimientoNse.nuevo', $input['encuesta'])
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
		$RequerimientoNse = $this->RequerimientoNse->findOrFail($id);

		return View::make('RequerimientoNses.show', compact('RequerimientoNse'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$RequerimientoNse = $this->RequerimientoNse->find($id);

		if (is_null($RequerimientoNse))
		{
			return Redirect::route('RequerimientoNse.index');
		}

		return View::make('RequerimientoNses.edit', compact('RequerimientoNse'));
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
		$validation = Validator::make($input, RequerimientoNse::$rules);

		if ($validation->passes())
		{
			$RequerimientoNse = $this->RequerimientoNse->find($id);
			$RequerimientoNse->update($input);

			return Redirect::route('RequerimientoNse.show', $id);
		}

		return Redirect::route('RequerimientoNse.edit', $id)
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
		$encuesta = $this->RequerimientoNse->find($id)->encuesta;
		$this->RequerimientoNse->find($id)->delete();

		return Redirect::route('Requerimientos', $encuesta);
	}

	public function nuevo($id)
	{
		$req = RequerimientoNse::where('encuesta', $id)->lists('nse');
		if ($req) {
			$NSE = NivelSocioEconomico::whereNotIn('id', $req)->where('activo', '1')->lists('nombre', 'id');
		}else{
			$NSE = NivelSocioEconomico::where('activo', '1')->lists('nombre', 'id');
		}
		return View::make('RequerimientoNses.create', compact('id', 'NSE'));
	}

}
