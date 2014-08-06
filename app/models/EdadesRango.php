<?php

class EdadesRango extends Eloquent {
	protected $guarded = array();

	protected $table = 'edades_rango';

	public static $rules = array(
		'id' => '',
		'edad_inicio' => 'required',
		'edad_final' => 'required',
		'activo' => 'required'
	);
}
