<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEdadesRangosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('EdadesRangos', function(Blueprint $table) {
			$table->increments('id');
			$table->int('id');
			$table->int('edad_inicio');
			$table->int('edad_final');
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
		Schema::drop('EdadesRangos');
	}

}
