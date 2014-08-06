<?php

use Mockery as m;
use Way\Tests\Factory;

class RequerimientonsesTest extends TestCase {

	public function __construct()
	{
		$this->mock = m::mock('Eloquent', 'RequerimientoNse');
		$this->collection = m::mock('Illuminate\Database\Eloquent\Collection')->shouldDeferMissing();
	}

	public function setUp()
	{
		parent::setUp();

		$this->attributes = Factory::RequerimientoNse(['id' => 1]);
		$this->app->instance('RequerimientoNse', $this->mock);
	}

	public function tearDown()
	{
		m::close();
	}

	public function testIndex()
	{
		$this->mock->shouldReceive('all')->once()->andReturn($this->collection);
		$this->call('GET', 'RequerimientoNses');

		$this->assertViewHas('RequerimientoNses');
	}

	public function testCreate()
	{
		$this->call('GET', 'RequerimientoNses/create');

		$this->assertResponseOk();
	}

	public function testStore()
	{
		$this->mock->shouldReceive('create')->once();
		$this->validate(true);
		$this->call('POST', 'RequerimientoNses');

		$this->assertRedirectedToRoute('RequerimientoNses.index');
	}

	public function testStoreFails()
	{
		$this->mock->shouldReceive('create')->once();
		$this->validate(false);
		$this->call('POST', 'RequerimientoNses');

		$this->assertRedirectedToRoute('RequerimientoNses.create');
		$this->assertSessionHasErrors();
		$this->assertSessionHas('message');
	}

	public function testShow()
	{
		$this->mock->shouldReceive('findOrFail')
				   ->with(1)
				   ->once()
				   ->andReturn($this->attributes);

		$this->call('GET', 'RequerimientoNses/1');

		$this->assertViewHas('RequerimientoNse');
	}

	public function testEdit()
	{
		$this->collection->id = 1;
		$this->mock->shouldReceive('find')
				   ->with(1)
				   ->once()
				   ->andReturn($this->collection);

		$this->call('GET', 'RequerimientoNses/1/edit');

		$this->assertViewHas('RequerimientoNse');
	}

	public function testUpdate()
	{
		$this->mock->shouldReceive('find')
				   ->with(1)
				   ->andReturn(m::mock(['update' => true]));

		$this->validate(true);
		$this->call('PATCH', 'RequerimientoNses/1');

		$this->assertRedirectedTo('RequerimientoNses/1');
	}

	public function testUpdateFails()
	{
		$this->mock->shouldReceive('find')->with(1)->andReturn(m::mock(['update' => true]));
		$this->validate(false);
		$this->call('PATCH', 'RequerimientoNses/1');

		$this->assertRedirectedTo('RequerimientoNses/1/edit');
		$this->assertSessionHasErrors();
		$this->assertSessionHas('message');
	}

	public function testDestroy()
	{
		$this->mock->shouldReceive('find')->with(1)->andReturn(m::mock(['delete' => true]));

		$this->call('DELETE', 'RequerimientoNses/1');
	}

	protected function validate($bool)
	{
		Validator::shouldReceive('make')
				->once()
				->andReturn(m::mock(['passes' => $bool]));
	}
}
