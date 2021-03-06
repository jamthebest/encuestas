<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$this->call('EncuestasTableSeeder');
		$this->call('PreguntasTableSeeder');
		$this->call('TiposTableSeeder');
		$this->call('OpcionesTableSeeder');
		$this->call('RespuestasTableSeeder');
		$this->call('PagosTableSeeder');
		$this->call('PreciosTableSeeder');
		$this->call('CiudadesTableSeeder');
		$this->call('Nivel_socio_economicosTableSeeder');
		$this->call('EdadesrangosTableSeeder');
		$this->call('RequerimientociudadsTableSeeder');
		$this->call('RequerimientoedadsTableSeeder');
		$this->call('RequerimientonsesTableSeeder');
		$this->call('RequerimientosexosTableSeeder');
		$this->call('SexosTableSeeder');
	}

}