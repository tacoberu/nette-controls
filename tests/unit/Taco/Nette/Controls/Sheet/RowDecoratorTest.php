<?php
/**
 * Copyright (c) since 2004 Martin Takáč (http://martin.takac.name)
 * @license   https://opensource.org/licenses/MIT MIT
 */

namespace Taco\Nette\Controls\Sheet;

use PHPUnit_Framework_TestCase;
use Taco\Utils\LazyIterator;
use Taco\Utils\Formaters\NullFormater;
use ArrayObject;


class RowDecoratorTest extends PHPUnit_Framework_TestCase
{

	function _testEmptyValue()
	{
		$deco = new RowDecorator(new LazyIterator(function() {
			return [];
		}));
dump($deco);
	}



	function testSample()
	{
		$deco = new RowDecorator(new ArrayObject([
			'x' => new Column('X', new NullFormater),
			'y' => new Column('Y', new NullFormater),
		]));
		$row = $deco->decore(['x' => 1, 'y' => 'abc']);
		$this->assertEquals((object) ['x' => 1, 'y' => 'abc']
				, $row->getRaw());
		$this->assertEqualsColumn(1, 'X', $row['x']);
		$this->assertEqualsColumn('abc', 'Y', $row['y']);
	}



	private function assertEqualsColumn($val, $header, Column $col)
	{
		$this->assertEquals($val, $col->getValue());
		$this->assertEquals($header, (string) $col->getHeader());
	}

}
