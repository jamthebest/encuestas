<?php

use Mockery as m;
use Way\Tests\Factory;

class NivelSocioEconomicosTest extends TestCase {

	public function __construct()
	{
		$this->mock = m::mock('Eloquent', 'Nivel_Socio_Economico');
		$this->collection = m::mock('Illuminate\Database\Eloquent\Collection')->shouldDeferMissing();
	}

	public function setUp()
	{
		parent::setUp();

		$this->attributes = Factory::Nivel_Socio_Economico(['id' => 1]);
		$this->app->instance('Nivel_Socio_Economico', $this->mock);
	}

	public function tearDown()
	{
		m::close();
	}

	public function testIndex()
	{
		$this->mock->shouldReceive('all')->once()->andReturn($this->collection);
		$this->call('GET', 'Nivel_Socio_Economicos');

		$this->assertViewHas('Nivel_Socio_Economicos');
	}

	public function testCreate()
	{
		$this->call('GET', 'Nivel_Socio_Economicos/create');

		$this->assertResponseOk();
	}

	public function testStore()
	{
		$this->mock->shouldReceive('create')->once();
		$this->validate(true);
		$this->call('POST', 'Nivel_Socio_Economicos');

		$this->assertRedirectedToRoute('Nivel_Socio_Economicos.index');
	}

	public function testStoreFails()
	{
		$this->mock->shouldReceive('create')->once();
		$this->validate(false);
		$this->call('POST', 'Nivel_Socio_Economicos');

		$this->assertRedirectedToRoute('Nivel_Socio_Economicos.create');
		$this->assertSessionHasErrors();
		$this->assertSessionHas('message');
	}

	public function testShow()
	{
		$this->mock->shouldReceive('findOrFail')
				   ->with(1)
				   ->once()
				   ->andReturn($this->attributes);

		$this->call('GET', 'Nivel_Socio_Economicos/1');

		$this->assertViewHas('Nivel_Socio_Economico');
	}

	public function testEdit()
	{
		$this->collection->id = 1;
		$this->mock->shouldReceive('find')
				   ->with(1)
				   ->once()
				   ->andReturn($this->collection);

		$this->call('GET', 'Nivel_Socio_Economicos/1/edit');

		$this->assertViewHas('Nivel_Socio_Economico');
	}

	public function testUpdate()
	{
		$this->mock->shouldReceive('find')
				   ->with(1)
				   ->andReturn(m::mock(['update' => true]));

		$this->validate(true);
		$this->call('PATCH', 'Nivel_Socio_Economicos/1');

		$this->assertRedirectedTo('Nivel_Socio_Economicos/1');
	}

	public function testUpdateFails()
	{
		$this->mock->shouldReceive('find')->with(1)->andReturn(m::mock(['update' => true]));
		$this->validate(false);
		$this->call('PATCH', 'Nivel_Socio_Economicos/1');

		$this->assertRedirectedTo('Nivel_Socio_Economicos/1/edit');
		$this->assertSessionHasErrors();
		$this->assertSessionHas('message');
	}

	public function testDestroy()
	{
		$this->mock->shouldReceive('find')->with(1)->andReturn(m::mock(['delete' => true]));

		$this->call('DELETE', 'Nivel_Socio_Economicos/1');
	}

	protected function validate($bool)
	{
		Validator::shouldReceive('make')
				->once()
				->andReturn(m::mock(['passes' => $bool]));
	}
}
