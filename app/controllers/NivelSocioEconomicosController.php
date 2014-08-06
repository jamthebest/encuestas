<?php

class NivelSocioEconomicosController extends BaseController {

	/**
	 * NivelSocioEconomico Repository
	 *
	 * @var NivelSocioEconomico
	 */
	protected $NivelSocioEconomico;

	public function __construct(NivelSocioEconomico $NivelSocioEconomico)
	{
		$this->NivelSocioEconomico = $NivelSocioEconomico;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$NivelSocioEconomicos = $this->NivelSocioEconomico->all();

		return View::make('NivelSocioEconomicos.index', compact('NivelSocioEconomicos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('NivelSocioEconomicos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, NivelSocioEconomico::$rules);

		if ($validation->passes())
		{
			$this->NivelSocioEconomico->create($input);

			return Redirect::route('NivelSocioEconomicos.index');
		}

		return Redirect::route('NivelSocioEconomicos.create')
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
		$NivelSocioEconomico = $this->NivelSocioEconomico->findOrFail($id);

		return View::make('NivelSocioEconomicos.show', compact('NivelSocioEconomico'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$NivelSocioEconomico = $this->NivelSocioEconomico->find($id);

		if (is_null($NivelSocioEconomico))
		{
			return Redirect::route('NivelSocioEconomicos.index');
		}

		return View::make('NivelSocioEconomicos.edit', compact('NivelSocioEconomico'));
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
		$validation = Validator::make($input, NivelSocioEconomico::$rules);

		if ($validation->passes())
		{
			$NivelSocioEconomico = $this->NivelSocioEconomico->find($id);
			$NivelSocioEconomico->update($input);

			return Redirect::route('NivelSocioEconomicos.show', $id);
		}

		return Redirect::route('NivelSocioEconomicos.edit', $id)
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
		$this->NivelSocioEconomico->find($id)->delete();

		return Redirect::route('NivelSocioEconomicos.index');
	}

}
