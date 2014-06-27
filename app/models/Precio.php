<?php

class Precio extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'id' => 'required',
		'preguntas' => 'required',
		'panelistas' => 'required',
		'precio' => 'required'
	);
}
