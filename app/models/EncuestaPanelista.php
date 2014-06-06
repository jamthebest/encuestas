<?php

class EncuestaPanelista extends Eloquent {
	protected $guarded = array();

	protected $table = 'encuesta_panelista';
	
	public static $rules = array(
		'encuesta' => 'required',
		'panelista' => 'required',
		'contestada' => 'required'
	);
}
