<?php

class Opcione extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'id' => 'required',
		'descripcion' => 'required',
		'pregunta' => 'required'
	);
}
