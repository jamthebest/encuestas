<?php

class Precio extends Eloquent {
	protected $guarded = array();

	protected $table = 'precios';

	public static $rules = array(
		'id' => '',
		'preguntas' => 'required|integer',
		'panelistas' => 'required|integer',
		'precio' => 'required|numeric'
	);
}
