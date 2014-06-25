<?php

class PagosController extends BaseController {

	/**
	 * Pago Repository
	 *
	 * @var Pago
	 */
	protected $pago;

	public function __construct(Pago $pago)
	{
		$this->pago = $pago;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		$pagos = $this->pago->where('encuesta', $id)->paginate(10);
		$encuesta = Encuesta::find($id);
		if ($encuesta) {
			return View::make('pagos.index', compact('pagos', 'encuesta'));
		}
		return Redirect::route('Encuestas.todas')->with('message', 'Permiso Denegado!');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
		$encuesta = Encuesta::find($id);
		if ($encuesta) {
			return View::make('pagos.create', compact('encuesta'));
		}
		return Redirect::route('Encuestas.todas')->withErrors('Permiso Denegado!');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Pago::$rules);

		if ($validation->passes())
		{
			$this->pago->create($input);
			$encuesta = Encuesta::find($input['encuesta']);
			if ($encuesta) {
				$encuesta->pagada = 1;
				$encuesta->save();
			}

			return Redirect::route('Configurar', $input['encuesta'])->with('message', 'Pago Realizado!');
		}

		return Redirect::route('CrearPagos', $input['encuesta'])
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
		$pago = $this->pago->findOrFail($id);

		return View::make('pagos.show', compact('pago'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$pago = $this->pago->find($id);

		if (is_null($pago))
		{
			return Redirect::route('Encuestas/Pagos.index');
		}

		return View::make('pagos.edit', compact('pago'));
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
		$validation = Validator::make($input, Pago::$rules);

		if ($validation->passes())
		{
			$pago = $this->pago->find($id);
			$pago->update($input);

			return Redirect::route('Encuestas/Pagos.show', $id);
		}

		return Redirect::route('Encuestas/Pagos.edit', $id)
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
		$this->pago->find($id)->delete();

		return Redirect::route('Encuestas/Pagos.index');
	}


	public function finalizar($id)
	{
		$pago = $this->pago->find($id);
		$encuesta = Encuesta::find($pago->encuesta);

		if ($enceusta) {
			$enceusta->pagada = 0;
			$enceusta->save();
		}

		return Redirect::route('Encuestas/Pagos.index');
	}

}
