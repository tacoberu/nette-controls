<?php
/**
 * Copyright (c) since 2004 Martin Takáč (http://martin.takac.name)
 * @license   https://opensource.org/licenses/MIT MIT
 */

namespace Taco\Nette\Controls\Table;

use Iterator as StdIterator,
	Countable;


/**
 * Decorate of content.
 */
class Iterator implements StdIterator, Countable
{
	/** @var array */
	private $values;

	/** @var ??? */
	private $decorator;

	/** @var int */
	private $pointer;


	/**
	 * @param  DibiResult
	 */
	public function __construct($values, RowDecorator $decorator)
	{
		if ($values instanceof StdIterator) {
			$values = iterator_to_array($values);
		}
		$this->values = $values;
		$this->decorator = $decorator;
	}



	/**
	 * Rewinds the iterator to the first element.
	 * @return void
	 */
	public function rewind()
	{
		$this->pointer = 0;
	}



	/**
	 * Returns the key of the current element.
	 * @return mixed
	 */
	public function key()
	{
		return $this->pointer;
	}



	/**
	 * Returns the current element.
	 * @return mixed
	 */
	public function current()
	{
		return $this->decorator->decore($this->values[$this->pointer]);
	}



	/**
	 * Moves forward to next element.
	 * @return void
	 */
	public function next()
	{
		$this->pointer++;
	}



	/**
	 * Checks if there is a current element after calls to rewind() or next().
	 * @return bool
	 */
	public function valid()
	{
		return isset($this->values[$this->pointer]);
	}



	/**
	 * Required by the Countable interface.
	 * @return int
	 */
	public function count()
	{
		return count($this->values);
	}

}
