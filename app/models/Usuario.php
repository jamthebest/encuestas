<?php

class Usuario extends Eloquent{
	protected $guarded = array();

	protected $table = 'usuarios';
	protected $fillable = array('username', 'correo', 'password', 'activo');

	public static $rules = array(
		'id' => '',
		'username' => 'required|unique:usuarios',
		'correo' => 'required|email|unique:usuarios',
		'password' => 'required',
		'tipo' => 'require',
		'activo' => ''
	);
}
