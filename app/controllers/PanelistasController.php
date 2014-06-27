<?php

class PanelistasController extends BaseController {

	
	protected $Usuario;
	
	public function __construct(Usuario $Usuario)
	{
		$this->Usuario = $Usuario;
	}

	public function index()
	{
		if (!Auth::check()) {
			return Redirect::to('Login')->with('message','Debe Autenticarse Primero!');
		}else if(Auth::user()->tipo == 'cliente'){
			return Redirect::to('Inicio')->with('message','Permiso Denegado!');
		}

		$Encuestas = DB::table('encuestas')
								->join('encuesta_panelista', 'encuestas.id', '=', 'encuesta_panelista.encuesta')
								->select('encuestas.id', 'encuestas.nombre', 'encuestas.descripcion', 'encuestas.despedida', 'encuestas.promopuntos', 'encuesta_panelista.contestada')
								->where('activa', '1')->where('pagada', '1')->where('encuesta_panelista.panelista', Auth::user()->id)
								//->where('encuesta_panelista.contestada', '0')
								->paginate(10);
		return View::make('Panelistas.index', compact('Encuestas'));
	}

	public function show($id){
		if (!Auth::check()) {
			return Redirect::to('Login')->with('message','Debe Autenticarse Primero!');
		}else if(Auth::user()->tipo == 'cliente'){
			return Redirect::to('Inicio')->with('message','Permiso Denegado!');
		}
		
		if (Auth::check()) {
			$Encuesta = Encuesta::find($id);
			$Panel = EncuestaPanelista::where('encuesta', $id)->where('panelista', Auth::user()->id)->first();
			if ($Panel && $Encuesta) {
				if ($Encuesta->activa == 1 && $Encuesta->pagada == 1 && $Panel->contestada == 0) {
					$Preguntas = Pregunta::where('encuesta', $Encuesta->id)->get();
					$preg = Pregunta::select('id')->where('encuesta', $Encuesta->id)->lists('id');
					$Opciones = Opcion::whereIn('pregunta', $preg)->get();
					$cont = 0;
					$opc = array();
					
					return View::make('Panelistas.contestar', compact('Encuesta', 'Preguntas', 'Opciones', 'cont', 'opc'));
				}
			}
		}
		return Redirect::to('Inicio')->with('message', 'Permiso denegado');
	}

	public function store($id)
	{
		return Input::all();
	}

	public function bienvenida($id)
	{
		$Encuesta = Encuesta::find($id);
		if ($Encuesta) {
			return View::make('Panelistas.Bienvenida', compact('Encuesta'));
		}
		return Redirect::route('MisEncuestas')->withErrors('Permiso Denegado!');
	}

	public function despedida($id)
	{
		$Encuesta = Encuesta::find($id);
		if ($Encuesta) {
			return View::make('Panelistas.Despedida', compact('Encuesta'));
		}
		return Redirect::route('MisEncuestas')->withErrors('Permiso Denegado!');
	}

}
