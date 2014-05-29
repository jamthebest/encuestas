<?php

class Tipo extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'id' => 'required',
		'nombre' => 'required',
		'descripcion' => 'required'
	);
}
