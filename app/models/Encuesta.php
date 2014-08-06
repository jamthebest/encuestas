<?php

class Encuesta extends Eloquent {
	protected $guarded = array();

	protected $table = 'encuestas';
	
	public static $rules = array(
		'id' => '',
		'nombre' => 'required',
		'panelistas' => 'required|min:1|Integer',
		'descripcion' => '',
		'despedida' => '',
		'promopuntos' => '',
		'usuario' => 'required'
	);
}
