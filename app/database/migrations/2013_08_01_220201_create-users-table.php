<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('usuarios', function($table){
	       $table->create();
	       $table->increments('id');
	       $table->string('username',50);
	       $table->string('correo',128);
	       $table->string('password',62);
	       $table->string('tipo',45);
	       $table->integer('activo');
	       $table->string('remember_token');
	       $table->timestamps();
    	});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usuarios');
	}

}
