<?php

class NivelSocioEconomico extends Eloquent {
	protected $guarded = array();

	protected $table = 'nivel_socio_economico';

	public static $rules = array(
		'id' => '',
		'codigo' => 'required',
		'nombre' => 'required',
		'descripcion' => '',
		'activo' => 'required'
	);
}
