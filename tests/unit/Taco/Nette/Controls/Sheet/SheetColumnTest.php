<?php
/**
 * This file is part of the Taco Projects.
 *
 * Copyright (c) 2004, 2013 Martin Takáč (http://martin.takac.name)
 *
 * For the full copyright and license information, please view
 * the file LICENCE that was distributed with this source code.
 *
 * PHP version 5.3
 *
 * @author     Martin Takáč (martin@takac.name)
 */


namespace Taco\Nette\Controls\Sheet;


require_once __dir__ . '/../../../../../../vendor/autoload.php';
require_once __dir__ . '/../../../../../../libs/Taco/Nette/Controls/Table/columns/TextColumn.php';


use PHPUnit_Framework_TestCase;
use Taco\Utils\Formaters\NullFormater,
	Taco\Utils\Formaters\ClosureFormater;


/**
 * @call phpunit --bootstrap ../../../../../bootstrap.php SheetColumnTest.php
 */
class SheetColumnTest extends PHPUnit_Framework_TestCase
{


	function testEmptyValue()
	{
		$entry = new Column('abc', new NullFormater());
		$this->assertEquals('abc', $entry->getHeader());
		$this->assertNull($entry->getValue());
		$this->assertEquals('', (string)$entry);
	}



	function testStringValue()
	{
		$entry = new Column('abc', new NullFormater());
		$entry->setValue('xyz');
		$this->assertEquals('abc', $entry->getHeader());
		$this->assertEquals('xyz', $entry->getValue());
		$this->assertEquals('xyz', (string)$entry);
	}



	function testIntValue()
	{
		$entry = new Column('abc', new NullFormater());
		$entry->setValue(123);
		$this->assertEquals('abc', $entry->getHeader());
		$this->assertEquals(123, $entry->getValue());
		$this->assertEquals('123', (string)$entry);
	}



	function testFailInCallback()
	{
		$entry = new Column('abc', new ClosureFormater(function($m) {
			throw new \Exception('ha');
		}));
		$entry->setValue(123);
		$this->assertEquals('abc', $entry->getHeader());
		$this->assertEquals(123, $entry->getValue());
		$this->assertEquals("Invalid format of value with error: `ha'.", (string)$entry);
	}



}
