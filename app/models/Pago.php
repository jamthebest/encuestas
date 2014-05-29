<?php

class Pago extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'id' => 'required',
		'monto' => 'required',
		'fecha' => 'required',
		'encuesta' => 'required',
		'descripcion' => 'required'
	);
}
