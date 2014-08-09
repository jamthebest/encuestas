<?php

class EdadesRango extends Eloquent {
	protected $guarded = array();

	protected $table = 'edades_rango';

	public static $rules = array(
		'id' => '',
		'edad_inicio' => 'required|integer',
		'edad_final' => 'required|integer',
		'activo' => 'required'
	);
}
