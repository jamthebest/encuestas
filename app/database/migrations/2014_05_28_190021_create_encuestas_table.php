<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEncuestasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('encuestas', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('id');
			$table->string('nombre');
			$table->text('descripcion');
			$table->text('despedida');
			$table->int('promopuntos');
			$table->int('usuario');
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
		Schema::drop('encuestas');
	}

}
