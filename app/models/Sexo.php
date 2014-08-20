<?php

class Sexo extends Eloquent {
	protected $guarded = array();

	protected $table = 'sexo';

	public static $rules = array(
		'id' => '',
		'nombre' => 'required',
		'descripcion' => '',
		'porcentaje' => 'required|numeric',
		'activo' => 'required'
	);
}
