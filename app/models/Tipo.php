<?php

class Tipo extends Eloquent {
	protected $guarded = array();

	protected $table = 'tipos';

	public static $rules = array(
		'id' => 'required',
		'nombre' => 'required',
		'descripcion' => 'required'
	);
}
