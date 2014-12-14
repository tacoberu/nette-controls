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


use Iterator as StdIterator,
	Traversable,
	IteratorAggregate;


/**
 * Iterate of content. Apply decorator to each row.
 */
class Iterator implements StdIterator
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
	}



	/**
	 * Returns the key of the current element.
	 * @return mixed
	 */
	function key()
	{
		return $this->iterator->key();
	}



	/**
	 * Returns the current element.
	 * @return mixed
	 */
	function current()
	{
		return $this->decorator->decore($this->iterator->current());
	}



	/**
	 * Moves forward to next element.
	 * @return void
	 */
	function next()
	{
		$this->iterator->next();
	}



	/**
	 * Checks if there is a current element after calls to rewind() or next().
	 * @return bool
	 */
	function valid()
	{
		return $this->iterator->valid();
	}


}
