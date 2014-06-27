<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePreciosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Precios', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('id');
			$table->integer('preguntas');
			$table->integer('panelistas');
			$table->integer('precio');
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
		Schema::drop('Precios');
	}

}
