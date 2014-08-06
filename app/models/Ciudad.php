<?php

class Ciudad extends Eloquent {
	protected $guarded = array();

	protected $table = 'ciudades';

	public static $rules = array(
		'id' => '',
		'nombre' => 'required',
		'descripcion' => '',
		'activo' => 'required'
	);
}
