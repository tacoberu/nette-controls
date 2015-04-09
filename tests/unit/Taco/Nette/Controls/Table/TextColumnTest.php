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
require_once __dir__ . '/../../../../../../libs/Taco/Nette/Controls/Table/columns/TextColumn.php';


use PHPUnit_Framework_TestCase;


/**
 * @call phpunit --bootstrap ../../../../../bootstrap.php TextColumnTest.php
 */
class TextColumnTest extends PHPUnit_Framework_TestCase
{


	function testEmptyValue()
	{
		$entry = new TextColumn();
		$state = (object) array(
				'header' => Null,
				'formater' => Null,
				'sorted' => Null,
				'value' => Null,
				'render' => Null,
				);
		$this->assertState($state, $entry);
	}



	/**
	 * @dataProvider providerConstruct1
	 */
	public function _testConstruct1($in, $state)
	{
		$m = new TextColumn($in);
		$this->assertState($state, $m);
	}



	public function providerConstruct1()
	{
		return array(
			array('state' => (object)array('name' => 'a', 'surname' => 'b'), 'in' => (object)array('name' => 'a', 'surname' => 'b')),
		);
	}



	function testSetHeader()
	{
		$entry = new TextColumn();
		$entry->setHeader(new Header($entry, 'abc'));
		$state = (object) array(
				'header' => 'abc',
				'formater' => Null,
				'sorted' => Null,
				'value' => Null,
				'render' => Null,
				);
		$this->assertState($state, $entry);
	}



	function testSetValue()
	{
		$entry = new TextColumn();
		$entry->setValue('abc');
		$state = (object) array(
				'header' => Null,
				'formater' => Null,
				'sorted' => Null,
				'value' => 'abc',
				'render' => 'abc',
				);
		$this->assertState($state, $entry);
	}



	private function assertState($state, $entry)
	{
		$this->assertEquals($state->header, $entry->getHeader(), "Attrib `header'");
		$this->assertEquals($state->formater, $entry->getFormater(), "Attrib `formater'");
		$this->assertEquals($state->sorted, $entry->getSorted(), "Attrib `sorted'");
		$this->assertEquals($state->value, $entry->getValue(), "Attrib `value'");
		$this->assertOutputEquals($state->render, function() use ($entry) { $entry->render(); }, "Attrib `render'");
	}



	private function assertOutputEquals($state, $cb, $msg)
	{
		//	Execute value
		ob_start();
		$cb();
		$s = ob_get_contents();
		ob_end_clean();

		//	Assert
		$this->assertEquals($state, $s, $msg);
	}
}
