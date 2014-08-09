<?php

class PreciosController extends BaseController {

	/**
	 * Precio Repository
	 *
	 * @var Precio
	 */
	protected $Precio;

	public function __construct(Precio $Precio)
	{
		$this->Precio = $Precio;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$Precios = $this->Precio->paginate(10);

		return View::make('Precios.index', compact('Precios'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('Precios.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Precio::$rules);

		if ($validation->passes())
		{
			$this->Precio->create($input);

			return Redirect::route('Precios.index');
		}

		return Redirect::route('Precios.create')
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
		$Precio = $this->Precio->findOrFail($id);

		return View::make('Precios.show', compact('Precio'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$Precio = $this->Precio->find($id);

		if (is_null($Precio))
		{
			return Redirect::route('Precios.index');
		}

		return View::make('Precios.edit', compact('Precio'));
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
		$validation = Validator::make($input, Precio::$rules);

		if ($validation->passes())
		{
			$Precio = $this->Precio->find($id);
			$Precio->update($input);

			return Redirect::route('Precios.index');
		}

		return Redirect::route('Precios.edit', $id)
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
		$Precio = $this->Precio->find($id);
		$Precio->activo = 0;
		$Precio->save();

		return Redirect::route('Precios.index')->with('message', 'Precio Desactivado Correctamente');
	}

	public function activar($id)
	{
		$Precio = $this->Precio->find($id);
		$Precio->activo = 1;
		$Precio->save();

		return Redirect::route('Precios.index')->with('message', 'Precio Activado Correctamente');
	}

}
