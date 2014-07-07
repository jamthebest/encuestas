<?php

class RespuestasController extends BaseController {

	/**
	 * Respuesta Repository
	 *
	 * @var Respuesta
	 */
	protected $respuesta;

	public function __construct(Respuesta $respuesta)
	{
		$this->respuesta = $respuesta;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$respuestas = $this->respuesta->all();

		return View::make('respuestas.index', compact('respuestas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('respuestas.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($id)
	{
		if (!Auth::check()) {
			return Redirect::to('Login')->with('message','Debe Autenticarse Primero!');
		}else if(Auth::user()->tipo == 'cliente'){
			return Redirect::to('Inicio')->with('message','Permiso Denegado!');
		}

		$input = Input::all();
		//$opciones = Opcion::select('opciones.id', 'opciones.descripcion', 'pregunta')
			//		->join('preguntas', 'opciones.pregunta', '=', 'preguntas.id')
				//	->where('preguntas.encuesta', $id)
					//->get();
		//return $input;
		$preguntas = Pregunta::where('encuesta', $id)->get();
		$pasan = array();
		foreach ($preguntas as $pregunta) {
			$opciones = Opcion::select('opciones.id', 'opciones.descripcion', 'pregunta')
										->where('pregunta', $pregunta->id)
										->get();
			$pasa = false;
			//return $preguntas;
			if ($pregunta->tipo != 5)
				$x = 'opcion' . $pregunta->id;
			foreach ($opciones as $opcion) {
				//return $input;
				if ($pregunta->tipo == 5){
					$x = 'opcion' . $pregunta->id . '_' . $opcion->id;
				}

				if ( array_key_exists($x, $input)) {
					$op = $input[$x];
					if ($op != NULL && $op != "") {
						$pasa = true;
					}
				}
			}
			$pasan[$pregunta->id] = $pasa;
		}

		foreach ($pasan as $pass) {
			if (!$pass){
				return Redirect::route('Contestar', $id)
								->withErrors('Debe Contestar todas las preguntas!')
								->withInput();
			}
		}

		$all = array();
		//return $input;
		for (reset($input); $i = key($input); next($input)) {
			if ($i != '_token') {
				$x = substr($i, 6);
				$y = substr($input[$i], 0);
				$z = substr($i, -(strlen($y)+1));
				$w = '_' . $y;
				if ($z == $w){
					$x = substr($x, 0, strlen($i) - (strlen($w)+6));
				}
				$preguntas = Pregunta::where('id', $x)->get();
				foreach ($preguntas as $pregunta) {
					if ($pregunta->tipo == 5){
						$opciones = Opcion::select('opciones.id', 'opciones.descripcion', 'pregunta')
											->where('pregunta', $pregunta->id)
											->get();
						foreach ($opciones as $opcion) {
							$respuesta = array();
							//return $x . $z;
							if ($pregunta->id . '_' . $opcion->id == $x . $z) {
								$respuesta['descripcion'] = $opcion->descripcion;
								$respuesta['opcion'] = $opcion->id;
								$respuesta['panelista'] = Auth::user()->id;
								//$this->respuesta->create($respuesta);
								//Guardar
							}else{
								if (!(array_key_exists($opcion->id, $all) && $all[$opcion->id]['descripcion'] != 'NULL')){
									$respuesta['descripcion'] = 'NULL';
									$respuesta['opcion'] = $opcion->id;
									$respuesta['panelista'] = Auth::user()->id;
									//$this->respuesta->create($respuesta);
									//Guardar
								}else{
									$respuesta['descripcion'] = $all[$opcion->id]['descripcion'];
									$respuesta['opcion'] = $opcion->id;
									$respuesta['panelista'] = Auth::user()->id;
								}
							}
							//$respuesta['opcion'] = $opcion->id;
							$all[$opcion->id] = $respuesta;
						}
					}else{
						if ($pregunta->id == $x) {
							$opciones = Opcion::select('opciones.id', 'opciones.descripcion', 'pregunta')
											->where('pregunta', $pregunta->id)
											->get();
							$cont = 0;
							foreach ($opciones as $opcion) {
								$respuesta = array();
								if ($pregunta->tipo == 1){
									$respuesta['descripcion'] = $input[$i];
									$respuesta['opcion'] = $opcion->id;
									$respuesta['panelista'] = Auth::user()->id;
									//$this->respuesta->create($respuesta);
									//Guardar
								}
								else {
									if ($pregunta->tipo == 3 && $cont == $input[$i]){
										$respuesta['descripcion'] = $opcion->descripcion;
										$respuesta['opcion'] = $opcion->id;
										$respuesta['panelista'] = Auth::user()->id;
										//$this->respuesta->create($respuesta);
										//Guardar
									}else{
										if ($opcion->id == $input[$i]){
											$respuesta['descripcion'] = $opcion->descripcion;
											$respuesta['opcion'] = $opcion->id;
											$respuesta['panelista'] = Auth::user()->id;
											//$this->respuesta->create($respuesta);
											//Guardar
										}
										else{
											$respuesta['descripcion'] = 'NULL';
											$respuesta['opcion'] = $opcion->id;
											$respuesta['panelista'] = Auth::user()->id;
											//$this->respuesta->create($respuesta);
											//Guardar
										}
									}
								}
								//$respuesta['opcion'] = $opcion->id;
								$all[$opcion->id] = $respuesta;
								$cont += 1;
							}
						}
					}
				}
			}//$x = substr($i, 6);
		}
		//return $all;
		foreach ($all as $val) {
			$this->respuesta->create($val);
		}
		$encuesta = EncuestaPanelista::where('encuesta', $id)->where('panelista', Auth::user()->id)->first();
		$encuesta->contestada = 1;
		$encuesta->save();
		
		$Panel = DB::connection('info')->table('panel')->select('id_panel')->where('usuario', Auth::user()->username)->orWhere('email', Auth::user()->username)->first();
		$Encuesta = Encuesta::find($id);
		$puntos = array();
		$puntos['id_panel'] = $Panel->id_panel;
		$puntos['fecha'] = date("Y-m-d");;
		$puntos['hora'] = date("H:i:s");;
		$puntos['puntos'] = $Encuesta->promopuntos;
		$puntos['estado'] = 0;
		$puntos['recomendacion'] = 0;
		$puntos['id_recomendada'] = '';
		$promopuntos = DB::connection('info')->table('prom_puntos')->insert($puntos);

		return Redirect::route('Despedida', array($id))->with('message', 'Respuestas Enviadas!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$respuesta = $this->respuesta->findOrFail($id);

		return View::make('respuestas.show', compact('respuesta'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$respuesta = $this->respuesta->find($id);

		if (is_null($respuesta))
		{
			return Redirect::route('Encuestas/Respuestas.index');
		}

		return View::make('respuestas.edit', compact('respuesta'));
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
		$validation = Validator::make($input, Respuesta::$rules);

		if ($validation->passes())
		{
			$respuesta = $this->respuesta->find($id);
			$respuesta->update($input);

			return Redirect::route('Encuestas/Respuestas.show', $id);
		}

		return Redirect::route('Encuestas/Respuestas.edit', $id)
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
		$this->respuesta->find($id)->delete();

		return Redirect::route('Encuestas/Respuestas.index');
	}

}
