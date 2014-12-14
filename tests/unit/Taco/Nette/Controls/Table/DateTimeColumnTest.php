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
require_once __dir__ . '/../../../../../../libs/Taco/Nette/Controls/Table/columns/DateTimeColumn.php';


use PHPUnit_Framework_TestCase;


/**
 * @call phpunit --bootstrap ../../../../../bootstrap.php DateTimeColumnTest.php
 */
class DateTimeColumnTest extends PHPUnit_Framework_TestCase
{


	function testCreate0()
	{
		$entry = new DateTimeColumn();
		$state = (object) array(
				'header' => Null,
				'formater' => new DateTimeFormater(Null, '-'),
				'sorted' => Null,
				'value' => Null,
				'render' => '-',
				);
		$this->assertState($state, $entry);
	}



	function testCreate0SetHeader()
	{
		$entry = new DateTimeColumn();
		$entry->setHeader(new Header($entry, 'abc'));
		$state = (object) array(
				'header' => 'abc',
				'formater' => new DateTimeFormater(Null, '-'),
				'sorted' => Null,
				'value' => Null,
				'render' => '-',
				);
		$this->assertState($state, $entry);
	}



	function testCreate0SetValue()
	{
		$entry = new DateTimeColumn();
		$entry->setValue(new \DateTime('2013-11-22 01:23:45'));
		$state = (object) array(
				'header' => Null,
				'formater' => new DateTimeFormater(Null, '-'),
				'sorted' => Null,
				'value' => new \DateTime('2013-11-22 01:23:45'),
				'render' => '2013-11-22 01:23:45',
				);
		$this->assertState($state, $entry);
	}



	/**
	 * @dataProvider providerCreate1
	 */
	function testCreate1($in, $state)
	{
		$entry = new DateTimeColumn($in->format);
		$this->assertState($state, $entry);
	}



	function providerCreate1()
	{
		return array(
			array(
				(object)array('format' => 'Y.m.d H,i,s'),
				(object) array(
					'header' => Null,
					'formater' => new DateTimeFormater('Y.m.d H,i,s', '-'),
					'sorted' => Null,
					'value' => Null,
					'render' => '-',
					),
				),
		);
	}



	/**
	 * @dataProvider providerCreate2
	 */
	function testCreate2($in, $state)
	{
		$entry = new DateTimeColumn($in->format, $in->emptyFormat);
		$this->assertState($state, $entry);
	}



	/**
	 * @dataProvider providerCreate2
	 */
	function testCreate2SetValue($in, $state)
	{
		$entry = new DateTimeColumn($in->format, $in->emptyFormat);
		$entry->setValue(new \DateTime('2013-11-22 01:23:45'));
		$state->value = new \DateTime('2013-11-22 01:23:45');
		$state->render = '2013.11.22 01,23,45';
		$this->assertState($state, $entry);
	}



	function providerCreate2()
	{
		return array(
			array(
				(object)array(
					'format' => 'Y.m.d H,i,s',
					'emptyFormat' => '---'
					),
				(object) array(
					'header' => Null,
					'formater' => new DateTimeFormater('Y.m.d H,i,s', '---'),
					'sorted' => Null,
					'value' => Null,
					'render' => '---',
					),
			),
		);
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
