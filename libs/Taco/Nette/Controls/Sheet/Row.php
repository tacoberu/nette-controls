<?php
/**
 * Copyright (c) since 2004 Martin Takáč (http://martin.takac.name)
 * @license   https://opensource.org/licenses/MIT MIT
 */

namespace Taco\Nette\Controls\Sheet;

use LogicException,
	Traversable;
use Nette\Utils\ArrayHash;


/**
 * Provide one row of items.
 */
class Row extends ArrayHash
{

	private $raw;


	/**
	 * ?
	 */
	function __construct($raw)
	{
		$this->raw = $raw;
	}



	function getRaw()
	{
		return $this->raw;
	}



	function getIterator()
	{
		$inst = clone $this;
		unset($inst->raw);
		return new \RecursiveArrayIterator((array) $inst);
	}



	/**
	 * @deprecated
	 */
	function getRow()
	{
		return $this->raw;
	}

}
