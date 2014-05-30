<?php

class Pago extends Eloquent {
	protected $guarded = array();

	protected $table = 'pagos';

	public static $rules = array(
		'id' => 'required',
		'monto' => 'required',
		'fecha' => 'required',
		'encuesta' => 'required',
		'descripcion' => 'required'
	);
}
