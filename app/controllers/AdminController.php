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
		$Panelistas = array();
		foreach ($Encuestas as $encuesta) {
			$Panelistas[$encuesta->id] = EncuestaPanelista::where('encuesta', $encuesta->id)->count();
		}
		return View::make('Admin.Encuestas', compact('Encuestas', 'Usuarios', 'Panelistas'));
	}

	public function Asignar($id)
	{
		$Encuesta = Encuesta::find($id);

		$Cont = 0;
		$Ciudades = Ciudad::all();
		$Edades = EdadesRango::all();
		$NSE = NivelSocioEconomico::all();
		$Sexo = Sexo::all();
		$ReqCiudades = RequerimientoCiudad::where('encuesta', $id)->get();
		$ReqEdades = RequerimientoEdad::where('encuesta', $id)->get();
		$ReqNSE = RequerimientoNse::where('encuesta', $id)->get();
		$ReqSexo = RequerimientoSexo::where('encuesta', $id)->get();
		$texto = array();
		//return $ReqCiudades;
		if ($ReqCiudades->count()) {
			foreach ($ReqCiudades as $req) {
				$texto = $texto + array($Cont => array($req->id, 'Las Personas que vivan en esta Ciudad: ' . $Ciudades[$req->ciudad - 1]->nombre . '.', 'Ciudad'));
				$Cont += 1;
			}
		}
		if ($ReqEdades->count()) {
			foreach ($ReqEdades as $req) {
				$texto = $texto + array($Cont => array($req->id, 'Las Personas con edad entre ' . $Edades[$req->rango - 1]->edad_inicio . ' y ' . $Edades[$req->rango - 1]->edad_final . ' años.', 'Edad'));
				$Cont += 1;
			}
		}
		if ($ReqNSE->count()) {
			foreach ($ReqNSE as $req) {
				$texto = $texto + array($Cont => array($req->id, 'Las Personas que tengan un nivel socio económico ' . $NSE[$req->nse - 1]->nombre, 'NSE'));
				$Cont += 1;
			}
		}
		if ($ReqSexo->count()) {
			foreach ($ReqSexo as $req) {
				$texto = $texto + array($Cont => array($req->id, 'Las Personas que sean del sexo: ' . $Sexo[$req->sexo - 1]->nombre, 'Sexo'));
				$Cont += 1;
			}
		}

		$Panelistas = Usuario::where('tipo', 'panelista')->get();//->paginate(10);
		$Usuarios = Usuario::select('username')->where('tipo', 'panelista')->get();
		$Asignados = EncuestaPanelista::where('encuesta', $Encuesta->id)->get();
		$usuario = array();
			$cont = 0;
			foreach ($Usuarios as $user) {
				$usuario[$cont] = $user->username;
				$cont += 1;
			}
		$Nombres = DB::connection('info')->table('panel')
				->select('primer_nombre as nombre', 'primer_apellido as apellido', 'telefono_celular as celular', 'telefono_casa as casa', 'ciudad', 'email', 'usuario', 'ciudad', 'status', 'id_panel')
				->whereIn('usuario', $usuario)->orWhereIn('email', $usuario)
				->get();

		$Edad = DB::connection('info')->table('edad_panel')
					->lists('edad', 'id_panel');

		foreach ($Panelistas as $panel) {
			$panel['check'] = 0;
			foreach ($Asignados as $Asig) {
				if ($Asig->panelista == $panel->id) {
					$panel['check'] = 1;
				}	
			}
		}
		$opciones = DB::connection('info')->select('select distinct ciudad from panel where ciudad != "" order by ciudad asc');
		$Ciudades = array();
		$Ciudades[0] = "Busque por Ciudad";
		$Cont = 1;
		foreach ($opciones as $ciudad) {
			$Ciudades[$Cont] = $ciudad->ciudad;
			$Cont += 1;
		}
		$opciones = DB::connection('info')->select('select distinct status from panel where status != ""');
		$NSE = array();
		$NSE[0] = "Busque por NSE";
		$Cont = 1;
		foreach ($opciones as $nse) {
			$NSE[$Cont] = $nse->status;
			$Cont += 1;
		}
		$opciones = DB::connection('info')->select('select distinct edad from edad_panel where edad != "" order by edad ASC');
		$Edades = array();
		$Edades[0] = "Edad";
		$Cont = 1;
		foreach ($opciones as $edad) {
			$Edades[$Cont] = $edad->edad;
			$Cont += 1;
		}
		$Seleccionados = array(0,0,0,0,0);
		//return $Seleccionados[0];
		return View::make('Admin.Asignar', compact('Encuesta', 'Panelistas', 'Asignados', 'Nombres', 'Ciudades', 'NSE', 'Edades', 'Seleccionados', 'Edad', 'texto'));
	}

	public function search($id)
	{
		$input = Input::all();

		$Cont = 0;
		$Ciudades = Ciudad::all();
		$Edades = EdadesRango::all();
		$NSE = NivelSocioEconomico::all();
		$Sexo = Sexo::all();
		$ReqCiudades = RequerimientoCiudad::where('encuesta', $id)->get();
		$ReqEdades = RequerimientoEdad::where('encuesta', $id)->get();
		$ReqNSE = RequerimientoNse::where('encuesta', $id)->get();
		$ReqSexo = RequerimientoSexo::where('encuesta', $id)->get();
		$texto = array();
		//return $ReqCiudades;
		if ($ReqCiudades->count()) {
			foreach ($ReqCiudades as $req) {
				$texto = $texto + array($Cont => array($req->id, 'Las Personas que vivan en esta Ciudad: ' . $Ciudades[$req->ciudad - 1]->nombre . '.', 'Ciudad'));
				$Cont += 1;
			}
		}
		if ($ReqEdades->count()) {
			foreach ($ReqEdades as $req) {
				$texto = $texto + array($Cont => array($req->id, 'Las Personas con edad entre ' . $Edades[$req->rango - 1]->edad_inicio . ' y ' . $Edades[$req->rango - 1]->edad_final . ' años.', 'Edad'));
				$Cont += 1;
			}
		}
		if ($ReqNSE->count()) {
			foreach ($ReqNSE as $req) {
				$texto = $texto + array($Cont => array($req->id, 'Las Personas que tengan un nivel socio económico ' . $NSE[$req->nse - 1]->nombre, 'NSE'));
				$Cont += 1;
			}
		}
		if ($ReqSexo->count()) {
			foreach ($ReqSexo as $req) {
				$texto = $texto + array($Cont => array($req->id, 'Las Personas que sean del sexo: ' . $Sexo[$req->sexo - 1]->nombre, 'Sexo'));
				$Cont += 1;
			}
		}

		$Seleccionados[0] = $input['ciudad'];
		$Seleccionados[1] = $input['nse'];
		$Seleccionados[2] = $input['edad'];
		$Seleccionados[3] = $input['hasta'];
		$Seleccionados[4] = $input['sexo'];
		$Ciudades = array();
		$NSE = array();
		$Edades = array();
		$Encuesta = Encuesta::find($id);
		$Consulta = 'select p.usuario from panel p';
		$Consulta2 = 'select p.email from panel p';

		
		if ($input['edad'] != 0) {
			$opciones = DB::connection('info')->select('select distinct edad from edad_panel where edad != "" order by edad ASC');
			$Edades[0] = "Edad";
			$Cont = 1;
			foreach ($opciones as $edad) {
				$Edades[$Cont] = $edad->edad;
				$Cont += 1;
			}
			$Consulta = $Consulta . ' inner join edad_panel ep on ep.id_panel = p.id_panel';
			$Consulta2 = $Consulta2 . ' inner join edad_panel ep on ep.id_panel = p.id_panel';
			if ($input['hasta'] != 0) {
				$Consulta = $Consulta . ' where ep.edad between ' . $Edades[$input['edad']] . ' and ' . $Edades[$input['hasta']];
				$Consulta2 = $Consulta2 . ' where ep.edad between ' . $Edades[$input['edad']] . ' and ' . $Edades[$input['hasta']];
			}else{
				$Consulta = $Consulta . ' where ep.edad = ' . $Edades[$input['edad']];
				$Consulta2 = $Consulta2 . ' where ep.edad = ' . $Edades[$input['edad']];
			}
		}elseif ($input['hasta'] != 0) {
			$opciones = DB::connection('info')->select('select distinct edad from edad_panel where edad != "" order by edad ASC');
			$Edades[0] = "Edad";
			$Cont = 1;
			foreach ($opciones as $edad) {
				$Edades[$Cont] = $edad->edad;
				$Cont += 1;
			}
			$Consulta = $Consulta . ' inner join edad_panel ep on ep.id_panel = p.id_panel';
			$Consulta2 = $Consulta2 . ' inner join edad_panel ep on ep.id_panel = p.id_panel';
			$Consulta = $Consulta . ' where ep.edad < ' . $Edades[$input['hasta']];
			$Consulta2 = $Consulta2 . ' where ep.edad < ' . $Edades[$input['hasta']];
		}

		if ($input['nse'] != 0) {
			$opciones = DB::connection('info')->select('select distinct status from panel where status != ""');
			$NSE[0] = "Busque por NSE";
			$Cont = 1;
			foreach ($opciones as $nse) {
				$NSE[$Cont] = $nse->status;
				$Cont += 1;
			}
			if ($input['edad'] != 0 || $input['hasta'] != 0) {
				$Consulta = $Consulta . ' and p.status = \'' . $NSE[$input['nse']] . '\'';
				$Consulta2 = $Consulta2 . ' and p.status = \'' . $NSE[$input['nse']] . '\'';
			}else{
				$Consulta = $Consulta . ' where p.status = \'' . $NSE[$input['nse']]. '\'';
				$Consulta2 = $Consulta2 . ' where p.status = \'' . $NSE[$input['nse']]. '\'';
			}
		}

		if ($input['ciudad'] != 0) {
			$opciones = DB::connection('info')->select('select distinct ciudad from panel where ciudad != "" order by ciudad asc');
			$Ciudades[0] = "Busque por Ciudad";
			$Cont = 1;
			foreach ($opciones as $ciudad) {
				$Ciudades[$Cont] = $ciudad->ciudad;
				$Cont += 1;
			}
			if ($input['edad'] != 0 || $input['hasta'] != 0 || $input['nse'] != 0) {
				$Consulta = $Consulta . ' and p.ciudad = \'' . $Ciudades[$input['ciudad']] . '\'';
				$Consulta2 = $Consulta2 . ' and p.ciudad = \'' . $Ciudades[$input['ciudad']] . '\'';
			}else{
				$Consulta = $Consulta . ' where p.ciudad = \'' . $Ciudades[$input['ciudad']] . '\'';
				$Consulta2 = $Consulta2 . ' where p.ciudad = \'' . $Ciudades[$input['ciudad']] . '\'';
			}
		}

		if ($input['sexo'] != 0) {
			if ($input['edad'] != 0 || $input['hasta'] != 0 || $input['nse'] != 0 || $input['ciudad'] != 0) {
				$Consulta = $Consulta . ' and p.sexo = \'' . ($input['sexo'] == 1 ? 'M' : 'F') . '\'';
				$Consulta2 = $Consulta2 . ' and p.sexo = \'' . ($input['sexo'] == 1 ? 'M' : 'F') . '\'';
			}else{
				$Consulta = $Consulta . ' where p.sexo = \'' . ($input['sexo'] == 1 ? 'M' : 'F') . '\'';
				$Consulta2 = $Consulta2 . ' where p.sexo = \'' . ($input['sexo'] == 1 ? 'M' : 'F') . '\'';
			}
		}

		//return $Consulta;
		$Usuarios = array();
		$usuario = Usuario::select('username')->where('tipo', 'panelista')->lists('username');
		if ($input['edad'] != 0 || $input['hasta'] != 0 || $input['nse'] != 0 || $input['ciudad'] != 0 || $input['sexo'] != 0) {
			$con1 = DB::connection('info')->select($Consulta . ' and p.usuario != \'\'');
					//->whereIn('usuario', $usuario)
					//->get();
			$con2 = DB::connection('info')->select($Consulta2 . ' and p.usuario = \'\'');
					//->whereIn('email', $usuario)
					//->get();
		}else{
			$con1 = DB::connection('info')->select($Consulta . ' where p.usuario != \'\'');
					//->whereIn('usuario', $usuario)
					//->get();
			$con2 = DB::connection('info')->select($Consulta2 . ' where p.usuario = \'\'');
					//->whereIn('email', $usuario)
					//->get();
		}
		$cont = 0;
		foreach ($con1 as $con) {
			$Usuarios[$cont] = $con->usuario;
			$cont += 1;
		}
		foreach ($con2 as $con) {
			$Usuarios[$cont] = $con->email;
			$cont += 1;
		}
		//return $Usuarios;
		

		$Encuesta = Encuesta::find($id);
		if ($Usuarios) {
			$Panelistas = Usuario::where('tipo', 'panelista')->whereIn('username', $Usuarios)->get();//->paginate(10);
			$Usuarios = Usuario::select('username')->where('tipo', 'panelista')->get();
			$Asignados = EncuestaPanelista::where('encuesta', $Encuesta->id)->get();
			$usuario = array();
			$cont = 0;
			foreach ($Usuarios as $user) {
				$usuario[$cont] = $user->username;
				$cont += 1;
			}
			
			$Nombres = DB::connection('info')->table('panel')
					->select('primer_nombre as nombre', 'primer_apellido as apellido', 'telefono_celular as celular', 'telefono_casa as casa', 'ciudad', 'email', 'usuario', 'ciudad', 'status', 'id_panel')
					->whereIn('usuario', $usuario)->orWhereIn('email', $usuario)
					->get();

			$Edad = DB::connection('info')->table('edad_panel')
					->lists('edad', 'id_panel');
			
			foreach ($Panelistas as $panel) {
				$panel['check'] = 0;
				foreach ($Asignados as $Asig) {
					if ($Asig->panelista == $panel->id) {
						$panel['check'] = 1;
					}	
				}
			}
		}else{
			$Panelistas = array();
			$Asignados = array();
			$Nombres = array();
		}
		$opciones = DB::connection('info')->select('select distinct ciudad from panel where ciudad != "" order by ciudad asc');
		$Ciudades = array();
		$Ciudades[0] = "Busque por Ciudad";
		$Cont = 1;
		foreach ($opciones as $ciudad) {
			$Ciudades[$Cont] = $ciudad->ciudad;
			$Cont += 1;
		}
		$opciones = DB::connection('info')->select('select distinct status from panel where status != ""');
		$NSE = array();
		$NSE[0] = "Busque por NSE";
		$Cont = 1;
		foreach ($opciones as $nse) {
			$NSE[$Cont] = $nse->status;
			$Cont += 1;
		}
		$opciones = DB::connection('info')->select('select distinct edad from edad_panel where edad != "" order by edad ASC');
		$Edades = array();
		$Edades[0] = "Edad";
		$Cont = 1;
		foreach ($opciones as $edad) {
			$Edades[$Cont] = $edad->edad;
			$Cont += 1;
		}

		
		return View::make('Admin.Asignar', compact('Encuesta', 'Panelistas', 'Asignados', 'Nombres', 'Ciudades', 'NSE', 'Edades', 'Seleccionados', 'Edad', 'texto'));
			//->withInput();
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

	public function resultados()
	{
		if (Auth::user()) {
			$encuestas = Encuesta::paginate(10);
			
			return View::make('Admin.resultados', compact('encuestas'));
		}
		return Redirect::to('Login')->with('message','Debe Autenticarse Primero!');
	}

	public function resultado($id)
	{
		if (Auth::check()) {
			$encuesta = Encuesta::find($id);
			if ($encuesta) {
				$preguntas = Pregunta::where('encuesta', $id)->get();
				if ($preguntas->count()) {
					$preg = $preguntas->lists('id');
					$opciones = Opcion::whereIn('pregunta', $preg)->get();
					if ($opciones->count()) {
						$resultados = array();
						$texto = array();
						$num = 0;
						$cont = 0;
						foreach ($opciones as $opcion) {
							$respuestas = Respuesta::where('opcion', $opcion->id)->get();
							$resultados[$opcion->id] = 0;
							if ($opcion->descripcion != 'Texto' && $opcion->descripcion != 'Otro') {
								foreach ($respuestas as $respuesta) {
									if ($num == 0) {
										$num = $opcion->id;
									}
									if ($num == $opcion->id) {
										$cont += 1;
									}
									if ($respuesta->descripcion == $opcion->descripcion) {
										$resultados[$opcion->id] += 1;
									}
								}
							}else{
								if ($opcion->descripcion == 'Otro') {
									foreach ($respuestas as $respuesta) {
										if ($num == 0) {
											$num = $opcion->id;
										}
										if ($num == $opcion->id) {
											$cont += 1;
										}
										if ($respuesta->descripcion) {
											$resultados[$opcion->id] += 1;
										}
									}
								}
								$texto[$opcion->id] = "";
								$tam = 0;
								foreach ($respuestas as $respuesta) {
									if ($num == 0) {
										$num = $opcion->id;
									}
									if ($num == $opcion->id) {
										$cont += 1;
									}
									if ($respuesta->descripcion != 'NULL'){
										$texto[$opcion->id] .= ($tam == 0 ? "" : ", ") . $respuesta->descripcion . "\n";
										$tam += 1;
									}
								}
							}
						}
						return View::make('Admin.resultado', compact('resultados', 'texto', 'preguntas', 'opciones', 'encuesta', 'cont'));
					}
					return Redirect::route('Resultados.todos')->with('message', 'Una pregunta de la Encuesta no tiene ninguna Opción de respuesta');
				}
				return Redirect::route('Resultados.todos')->with('message', 'La Encuesta no tiene Preguntas');
			}
			return Redirect::route('Resultados.todos')->with('message', 'Permiso Denegado!');
		}
		return Redirect::to('Login')->with('message','Debe Autenticarse Primero!');
	}

	public function Promopuntos($id)
	{
		$input = Input::all();
		$encuesta = Encuesta::find($id);
		if ($encuesta) {
			$encuesta->promopuntos = $input['promopuntos'];
			$encuesta->save();
			return Redirect::route('Configurar', $id)->with('message', 'Promopuntos Asignados Correctamente!');
		}
		return Redirect::route('Configurar', $id)->withErrors('Error al Asignar Promopuntos!');
	}

	public function Configuracion()
	{
		return View::make('Admin.Configuracion');
	}

}
