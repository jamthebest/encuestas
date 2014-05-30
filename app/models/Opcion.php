<?php

class Opcion extends Eloquent {
	protected $guarded = array();

	protected $table = 'opciones';

	public static $rules = array(
		'id' => '',
		'descripcion' => 'required',
		'pregunta' => 'required'
	);
}
