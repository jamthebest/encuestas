<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequerimientoSexosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('RequerimientoSexos', function(Blueprint $table) {
			$table->increments('id');
			$table->int('id');
			$table->int('encuesta');
			$table->int('sexo');
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
		Schema::drop('RequerimientoSexos');
	}

}
