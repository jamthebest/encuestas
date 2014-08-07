<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSexosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Sexos', function(Blueprint $table) {
			$table->increments('id');
			$table->int('id');
			$table->string('nombre');
			$table->string('descripcion');
			$table->int('activo');
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
		Schema::drop('Sexos');
	}

}
