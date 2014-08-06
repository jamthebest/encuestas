<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequerimientoCiudadsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('RequerimientoCiudads', function(Blueprint $table) {
			$table->increments('id');
			$table->int('id');
			$table->int('encuesta');
			$table->int('ciudad');
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
		Schema::drop('RequerimientoCiudads');
	}

}
