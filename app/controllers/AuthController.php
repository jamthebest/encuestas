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
		// La autenticación ha fallado re-direccionamos
		// a la página anterior con los datos enviados
		// y con un mensaje de error
		return Redirect::back()->with('message', 'Datos incorrectos, vuelve a intentarlo.');
	}

	public function doLogout()
	{
		//Desconctamos al usuario
		Auth::logout();

		//Redireccionamos al inicio de la app con un mensaje
		return Redirect::to('Inicio')->with('message', 'Gracias por visitarnos!.');
	}

}
