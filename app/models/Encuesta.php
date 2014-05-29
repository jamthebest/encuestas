<?php

class Encuesta extends Eloquent {
	protected $guarded = array();

	protected $table = 'encuestas';
	
	public static $rules = array(
		'id' => '',
		'nombre' => 'required',
		'descripcion' => '',
		'despedida' => '',
		'promopuntos' => '',
		'usuario' => 'required'
	);
}
