<?php
/**
 * Copyright (c) since 2004 Martin Takáč (http://martin.takac.name)
 * @license   https://opensource.org/licenses/MIT MIT
 */

namespace Taco\Nette\Controls\Table;

use Iterator as StdIterator,
	Countable,
	Traversable,
	IteratorAggregate;


/**
 * Iterate of content. Apply decorator to each row.
 */
class Iterator implements StdIterator, Countable
{

	/** @var Iterator */
	private $iterator;


	/** @var RowDecorator */
	private $decorator;



	/**
	 * @param Traversable content.
	 */
	function __construct(Traversable $values, RowDecorator $decorator)
	{
		if ($values instanceof IteratorAggregate) {
			$this->iterator = $values->getIterator();
		}
		else {
			$this->iterator = $values;
		}

		$this->decorator = $decorator;
	}



	/**
	 * Rewinds the iterator to the first element.
	 * @return void
	 */
	function rewind()
	{
		$this->iterator->rewind();
		//~ reset($this->iterator);
	}



	/**
	 * Returns the key of the current element.
	 * @return mixed
	 */
	function key()
	{
		return $this->iterator->key();
		//~ return key($this->iterator);
	}



	/**
	 * Returns the current element.
	 * @return mixed
	 */
	function current()
	{
		return $this->decorator->decore($this->iterator->current());
		//~ return $this->decorator->decore(current($this->iterator));
	}



	/**
	 * Moves forward to next element.
	 * @return void
	 */
	function next()
	{
		$this->iterator->next();
		//~ next($this->iterator);
	}



	/**
	 * Checks if there is a current element after calls to rewind() or next().
	 * @return bool
	 */
	function valid()
	{
		return $this->iterator->valid();
		//~ return (bool) current($this->iterator);
	}



	/**
	 * @return int
	 */
	function count()
	{
		if ($this->iterator instanceof Countable) {
			return count($this->iterator);
		}
		return iterator_count($this->iterator);
	}

}
