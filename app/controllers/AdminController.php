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
		$Encuestas = Encuesta::paginate(10);
		$Usuarios = Usuario::all();
		return View::make('Admin.Encuestas', compact('Encuestas', 'Usuarios'));
	}

	public function Asignar($id)
	{
		$Encuesta = Encuesta::find($id);
		$Panelistas = Usuario::where('tipo', 'panelista')->paginate(10);
		$Usuarios = Usuario::select('username')->where('tipo', 'panelista')->get();
		$Asignados = EncuestaPanelista::where('encuesta', $Encuesta->id)->get();
		$usuario = array();
			$cont = 0;
			foreach ($Usuarios as $user) {
				$usuario[$cont] = $user->username;
				$cont += 1;
			}
		$Nombres = DB::connection('info')->table('panel')
				->select('primer_nombre as nombre', 'primer_apellido as apellido', 'telefono_celular as celular', 'telefono_casa as casa', 'ciudad', 'email', 'usuario')
				->whereIn('usuario', $usuario)->orWhereIn('email', $usuario)
				->get();
		foreach ($Panelistas as $panel) {
			$panel['check'] = 0;
			foreach ($Asignados as $Asig) {
				if ($Asig->panelista == $panel->id) {
					$panel['check'] = 1;
				}	
			}
		}
		//return $Panelistas;
		return View::make('Admin.Asignar', compact('Encuesta', 'Panelistas', 'Asignados', 'Nombres'));
	}

	public function Ver($id)
	{
		$Encuesta = Encuesta::find($id);
		$Panelistas = EncuestaPanelista::select('panelista')->where('encuesta', $Encuesta->id)->get();
		$panel = array();
		$cont = 0;
		foreach ($Panelistas as $panelista) {
			$panel[$cont] = $panelista->panelista;
			$cont += 1;
		}
		if ($panel) {
			$Usuarios = Usuario::select('username')->whereIn('id', $panel)->get();
			$usuario = array();
			$cont = 0;
			foreach ($Usuarios as $user) {
				$usuario[$cont] = $user->username;
				$cont += 1;
			}
			
			$Nombres = DB::connection('info')->table('panel')
				->select('primer_nombre as nombre', 'primer_apellido as apellido', 'telefono_celular as celular', 'telefono_casa as casa', 'ciudad', 'email', 'usuario')
				->whereIn('usuario', $usuario)->orWhereIn('email', $usuario)
				->paginate(10);
			//return $Nombres;
			return View::make('Admin.Ver', compact('Encuesta', 'Nombres'));
		}
		return Redirect::route('Encuestas.todas')->withErrors('La Encuesta no tiene Panelistas Asignados');
	}

	public function store()
	{
		$input = Input::all();
		$Encuesta = Encuesta::find($input['Encuesta']);
		$Asignados = EncuestaPanelista::where('encuesta', $Encuesta->id)->get();
		
		$asig = array();
		$cont = 0;
		foreach ($Asignados as $as) {
			$asig[$cont] = $as->panelista;
			$cont += 1;
		}
		foreach ($input as $in) {
			if (in_array(substr($in, 1), $asig)) {
				unset($input[$in]);
			}
		}
		$cont = 0;
		$in = array();
		for (reset($input); $i = key($input); next($input)) {
			$cont += 1;
			if ($i != '_token' && $i != 'Encuesta') {
				if (!in_array(substr($i, 1), $asig)) {
					$in[$i] = $input[$i];
				}
			}
		}
		for (reset($in); $i = key($in); next($in)) {
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

	public function Configurar($id)
	{
		$Encuesta = Encuesta::find($id);

		return View::make('Admin.Configurar', compact('Encuesta'));
	}

}
