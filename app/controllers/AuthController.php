<?php

class AuthController extends BaseController {

	/**
	 * Attempt user login
	 */
	public function doLogin()
	{
		// Obtenemos el usuario, borramos los espacios
		// y convertimos todo a minúscula
		$user = mb_strtolower(trim(Input::get('username')));
		// Obtenemos la contraseña enviada
		$password = Input::get('password');
		
		// Realizamos la autenticación
		if (Auth::attempt(['username' => $user, 'password' => $password]))
		{
			// Aquí también pueden devolver una llamada a otro controlador o
			// devolver una vista
			//$user = Auth::user()->user;
			return Redirect::to('Inicio')->with('message', 'Bienvenido '. Auth::user()->username . '!');
		}
		if ($user != null && $user != '') {
			$usuario = Usuario::where('username', $user)->first();
			$panel = DB::connection('info')->table('panel')->where('usuario', $user)->orWhere('email', $user)->first();

			if ($usuario) {
				if ($usuario->password == $password) {
					$us = User::find($usuario->id);
					Auth::login($us);
					return Redirect::to('Inicio')->with('message', 'Bienvenido/a '. $panel->primer_nombre . ' ' . $panel->primer_apellido . '!');
				}
			}
		}
			/*$panel = DB::connection('info')->select("select clave from panel where usuario = ? or email = ?", array($user, $user));
			if ($panel) {
				$clave = $panel[0]->clave;
				if ($clave == $password) {
					/*$tmp = DB::connection('info')->table('panel')->where('usuario', $user)->first();
					$userAuth = new User();
					$userAuth->id = $tmp->id_panel;
					$userAuth->username = $tmp->primer_nombre . ' ' . $tmp->primer_apellido;
					$userAuth->correo = $tmp->email;
					$userAuth->password = $tmp->clave;
					$userAuth->tipo = 'panelista';
					$userAuth->activo = '1';//*/
					/*$panel = DB::connection('info')->table('panel')->where('usuario', $user)->orWhere('email', $user)->first();
					$x = User::where('username', $user)->orWhere('correo', $user)->first();
					if ($x) {
						$userAuth = User::find($x->id);
						Auth::login($userAuth);
						return Redirect::to('Inicio')->with('message', 'Bienvenido/a '. $panel->primer_nombre . ' ' . $panel->primer_apellido . '!');//*/	
					/*}
					/*$tmp = DB::connection('info')->table('panel')->where('usuario', $user)->first();
					Session::put('id', $tmp->id_panel);
		      Session::put('username', $tmp->primer_nombre . ' ' . $tmp->primer_apellido);
		      Session::put('tipo', 'panelista');
		      Session::put('activa', '1');
		      
		      Response::json(array(
		          'success'         =>     true
		      ));
		      return Redirect::to('Inicio')->with('message', 'Bienvenido '. Session::get('username') . '!');//*/
				//}
			//}
		/*}//*/
		// La autenticación ha fallado re-direccionamos
		// a la página anterior con los datos enviados
		// y con un mensaje de error
		return Redirect::back()
				->with('message', 'Datos incorrectos, vuelve a intentarlo.')
				->withInput();
	}

	public function doLogout()
	{
		//Desconctamos al usuario
		if (Auth::user()) {
			Auth::logout();
		}
		

		//Redireccionamos al inicio de la app con un mensaje
		return Redirect::to('Inicio')->with('message', 'Gracias por visitarnos!.');
	}
}
