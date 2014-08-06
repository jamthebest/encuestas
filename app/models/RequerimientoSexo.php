<?php

class RequerimientoSexo extends Eloquent {
	protected $guarded = array();

	protected $table = 'requerimiento_sexo';

	public static $rules = array(
		'id' => '',
		'encuesta' => 'required',
		'sexo' => 'required'
	);
}
