<?php

class RequerimientoNse extends Eloquent {
	protected $guarded = array();

	protected $table = 'requerimiento_nse';

	public static $rules = array(
		'id' => '',
		'encuesta' => 'required',
		'nse' => 'required'
	);
}
