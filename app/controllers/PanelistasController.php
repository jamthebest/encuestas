<?php

class PanelistasController extends BaseController {

	
	protected $Usuario;
	
	public function __construct(Usuario $Usuario)
	{
		$this->Usuario = $Usuario;
	}

	public function index()
	{
		$Encuestas = DB::table('encuestas')
								->join('encuesta_panelista', 'encuestas.id', '=', 'encuesta_panelista.encuesta')
								->select('encuestas.id', 'encuestas.nombre', 'encuestas.descripcion', 'encuestas.despedida', 'encuestas.promopuntos')
								->where('activa', '1')->where('pagada', '1')->where('encuesta_panelista.panelista', Auth::user()->id)
								->where('encuesta_panelista.contestada', '0')
								->paginate(10);
		return View::make('Panelistas.index', compact('Encuestas'));
	}

	public function show($id){
		$Encuesta = Encuesta::find($id);
		$Preguntas = Pregunta::where('encuesta', $Encuesta->id)->get();
		$preg = Pregunta::select('id')->where('encuesta', $Encuesta->id)->lists('id');
		$Opciones = Opcion::whereIn('pregunta', $preg)->get();
		$cont = 0;
		$opc = array();
		
		return View::make('Panelistas.contestar', compact('Encuesta', 'Preguntas', 'Opciones', 'cont', 'opc'));
	}

	public function store($id)
	{
		return Input::all();
	}

}
