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
								->get();
		return View::make('Panelistas.index', compact('Encuestas'));
	}

	public function show($id){

	}

}
