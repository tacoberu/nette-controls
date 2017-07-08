<?php
/**
 * Copyright (c) since 2004 Martin Takáč (http://martin.takac.name)
 * @license   https://opensource.org/licenses/MIT MIT
 */

namespace Taco\Nette\Controls\Sheet;

use PHPUnit_Framework_TestCase;
use Taco\Utils\Formaters\NullFormater,
	Taco\Utils\Formaters\ClosureFormater;
use ArrayObject;


class IteratorTest extends PHPUnit_Framework_TestCase
{

	function testSample()
	{
		$deco = new RowDecorator(new ArrayObject([
			'x' => new Column('X', new NullFormater),
			'y' => new Column('Y', new NullFormater),
		]));
		$values = new ArrayObject([
			['x' => 1, 'y' => 'abc'],
			['x' => 2, 'y' => 'def'],
		]);
		$iter = new Iterator($values, $deco);
		$xs = iterator_to_array($iter);
		$this->assertInstanceOf('Taco\Nette\Controls\Sheet\Row', $xs[0]);
		$this->assertEquals((object) ['x' => 1, 'y' => 'abc'], $xs[0]->getRaw());
		$this->assertEquals((object) ['x' => 2, 'y' => 'def'], $xs[1]->getRaw());
	}



	function testCount()
	{
		$deco = new RowDecorator(new ArrayObject([
			'x' => new Column('X', new NullFormater),
			'y' => new Column('Y', new NullFormater),
		]));
		$values = new ArrayObject([
			['x' => 1, 'y' => 'abc'],
			['x' => 2, 'y' => 'def'],
		]);
		$iter = new Iterator($values, $deco);
		$this->assertEquals(2, count($iter));
	}



	function testCountEmpty()
	{
		$deco = new RowDecorator(new ArrayObject([
			'x' => new Column('X', new NullFormater),
			'y' => new Column('Y', new NullFormater),
		]));
		$values = new ArrayObject([]);
		$iter = new Iterator($values, $deco);
		$this->assertEquals(0, count($iter));
	}

}
