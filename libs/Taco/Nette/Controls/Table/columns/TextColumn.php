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


use Nette;


/**
 * Plain text column
 */
class TextColumn extends Nette\Application\UI\Control implements Column
{


	/** @var string */
	private $value;

	/** @var string */
	private $label;

	/** @var callback */
	//~ private $renderer = null;

	/** @var string */
	//~ private $columnName;



	/**
	 * Get label of column for head.
	 * @return string
	 */
	function getHeader()
	{
		return $this->label;
	}


	function setHeader($m)
	{
		$this->label = $m;
		return $this;
	}


	/**
	 * Content of current column
	 * @param string
	 */
	function setValue($m)
	{
		$this->value = $m;
		return $this;
	}


	/**
	 * Render cell
	 * @param mixed $record record
	 */
	function __toString()
	{
		return (string)$this->value;
	}


}
