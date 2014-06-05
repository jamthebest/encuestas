<?php

class AdminController extends BaseController {

	/**
	 * Encuesta Repository
	 *
	 * @var Encuesta
	 */
	public function __construct()
	{
	}

	public function Encuestas()
	{
		$Encuestas = Encuesta::all();
		return View::make('Admin.Encuestas', compact('Encuestas'));
	}

	public function Asignar($id)
	{
		$Encuesta = Encuesta::find($id);
		$Panelistas = Usuario::where('tipo', 'panelista')->get();
		//return $Panelistas;
		return View::make('Admin.Asignar', compact('Encuesta', 'Panelistas'));
	}

	public function store()
	{
		$input = Input::all();
		//return $input;
		for (reset($input); $i = key($input); next($input)) {
			if ($i != '_token' && $i != 'Encuesta') {
				$fila = array();
				$fila['panelista'] = substr($i, 1);
				$fila['encuesta'] = $input['Encuesta'];
				$fila['contestada'] = '0';
				EncuestaPanelista::create($fila);
			}
		}
		return Redirect::route('Encuestas.todas')->with('message', 'Panelistas Asignados Correctamente');
	}

}
