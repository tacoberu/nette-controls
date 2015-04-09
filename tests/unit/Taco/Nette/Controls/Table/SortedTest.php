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


namespace Taco\Nette\Controls\Table;


require_once __dir__ . '/../../../../../../vendor/autoload.php';
require_once __dir__ . '/../../../../../../libs/Taco/Nette/Controls/Table/Ordered.php';


use PHPUnit_Framework_TestCase;


/**
 *
 * @call...
 */
class SortedTest extends PHPUnit_Framework_TestCase
{


	/**
	 * unused = x        = clean
	 * asc    = <name>   = up
	 * desc   = <name>-  = down
	 */
	function testDefaultUnused()
	{
		$head = new Header(Null, 'John');
		$entry = new Sorted($head);
		$this->assertTrue($entry->isUnused());
		$this->assertFalse($entry->isAsc());
		$this->assertFalse($entry->isDesc());
		$this->assertEquals(Sorted::UNUSED, $entry->defaultState);
		$this->assertEquals(Sorted::ASC, $entry->upState);
		$this->assertEquals(Sorted::DESC, $entry->downState);

		$entry->state = Sorted::UNUSED;
		$this->assertEquals(Sorted::UNUSED, $entry->defaultState);
		$this->assertEquals(Sorted::ASC, $entry->upState);
		$this->assertEquals(Sorted::DESC, $entry->downState);

		$entry->state = Sorted::ASC;
		$this->assertEquals(Sorted::UNUSED, $entry->defaultState);

		$entry->state = Sorted::DESC;
		$this->assertEquals(Sorted::UNUSED, $entry->defaultState);
	}


	/**
	 * asc    = x
	 * desc   = <name>
	 * unused = <name>-
	 */
	function testDefaultAsc()
	{
		$head = new Header(Null, 'John');
		$entry = new Sorted($head, Sorted::ASC);
		$this->assertFalse($entry->isUnused());
		$this->assertTrue($entry->isAsc());
		$this->assertFalse($entry->isDesc());

		$this->assertEquals(Sorted::ASC, $entry->defaultState);
		$this->assertEquals(Sorted::DESC, $entry->upState);
		$this->assertEquals(Sorted::UNUSED, $entry->downState);
	}


	/**
	 * desc   = x       = clean
	 * unused = <name>  =
	 * asc    = <name>-
	 */
	function testDefaultDesc()
	{
		$head = new Header(Null, 'John');
		$entry = new Sorted($head, Sorted::DESC);
		$this->assertFalse($entry->isUnused());
		$this->assertFalse($entry->isAsc());
		$this->assertTrue($entry->isDesc());
		$this->assertEquals(Sorted::DESC, $entry->defaultState);
		$this->assertEquals(Sorted::UNUSED, $entry->upState);
		$this->assertEquals(Sorted::ASC, $entry->downState);

		$entry->state = Sorted::UNUSED;
		$this->assertEquals(Sorted::DESC, $entry->defaultState);
		$this->assertEquals(Sorted::UNUSED, $entry->upState);
		$this->assertEquals(Sorted::ASC, $entry->downState);

		$entry->state = Sorted::ASC;
		$this->assertEquals(Sorted::DESC, $entry->defaultState);
		$this->assertEquals(Sorted::UNUSED, $entry->upState);
		$this->assertEquals(Sorted::ASC, $entry->downState);

		$entry->state = Sorted::DESC;
		$this->assertEquals(Sorted::DESC, $entry->defaultState);
		$this->assertEquals(Sorted::UNUSED, $entry->upState);
		$this->assertEquals(Sorted::ASC, $entry->downState);
	}


}
