<?php

class UsuariosController extends BaseController {

	
	protected $Usuario;
	
	public function __construct(Usuario $Usuario)
	{
		$this->Usuario = $Usuario;
	}

	
	public function create()
	{
		return View::make('Usuarios.create');
	}

	public function store()
	{
		$input = Input::all();
		$val1 = Usuario::$rules;
		$val2 = Cliente::$rules;
		$val3 = $val1+$val2;
		$validation = Validator::make($input, $val3);
		
		if ($validation->passes())
		//if (true)
		{
			$user['username'] = $input['username'];
			$user['correo'] = $input['correo'];
			$user['password'] = Hash::make($input['password']);
			$user['tipo'] = $input['tipo'];
			$user['activo'] = '1';
			$this->Usuario->create($user);

			$usuario = Usuario::where('username', '=', $user['username'])->get();
			$cliente['empresa'] = $input['empresa'];
			$cliente['rtn'] = $input['rtn'];
			$cliente['direccion'] = $input['direccion'];
			$cliente['telefono'] = $input['telefono'];
			$cliente['correo'] = $input['correo_emp'];
			$cliente['representante'] = $input['representante'];
			$cliente['contacto'] = $input['contacto'];
			$cliente['correo_contacto'] = $input['correo_contacto'];
			$cliente['telefono_contacto'] = $input['telefono_contacto'];
			$cliente['usuario'] = $usuario[0]->id;
			Cliente::create($cliente);

			$username = $input['username'];
			$password = $input['password'];
			if (Auth::attempt(['username' => $username, 'password' => $password]))
			{
				return Redirect::to('Inicio')
					->with('message', 'Usuario Creado Exitosamente!');
			}
		}

		return Redirect::route('Registro')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	public function index()
	{
		$Usuarios = Usuario::paginate(10);

		return View::make('Usuarios.index', compact('Usuarios'));
	}

	public function requerimientos($id)
	{
		$Encuesta = Encuesta::find($id);
		$Cont = 0;
		if ($Encuesta) {
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
			//$texto = array();
			//return $texto[0][0];

			return View::make('Usuarios.requerimientos', compact('Encuesta', 'Ciudades', 'Edades', 'NSE', 'Sexo', 'ReqCiudades', 'ReqEdades', 'ReqNSE', 'ReqSexo', 'Cont', 'texto'));
		}

		return Redirect::route('Inicio')->withErrors('Error Desconocido');
	}

}
