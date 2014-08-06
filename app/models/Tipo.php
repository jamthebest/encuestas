<?php

class Tipo extends Eloquent {
	protected $guarded = array();

	protected $table = 'tipos';

	public static $rules = array(
		'id' => '',
		'nombre' => 'required',
		'descripcion' => 'required'
	);
}
