<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequerimientoEdadsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('RequerimientoEdads', function(Blueprint $table) {
			$table->increments('id');
			$table->int('id');
			$table->int('encuesta');
			$table->int('rango');
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
		Schema::drop('RequerimientoEdads');
	}

}
