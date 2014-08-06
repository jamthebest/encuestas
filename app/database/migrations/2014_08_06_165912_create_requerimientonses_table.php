<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequerimientoNsesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('RequerimientoNses', function(Blueprint $table) {
			$table->increments('id');
			$table->int('id');
			$table->int('encuesta');
			$table->int('nse');
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
		Schema::drop('RequerimientoNses');
	}

}
