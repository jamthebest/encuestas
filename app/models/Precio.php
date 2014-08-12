<?php

class Precio extends Eloquent {
	protected $guarded = array();

	protected $table = 'precios';

	public static $rules = array(
		'id' => '',
		'preguntas' => 'required',
		'panelistas' => 'required',
		'precio' => 'required|numeric'
	);
}
