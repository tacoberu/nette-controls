<?php
/**
 * Copyright (c) since 2004 Martin Takáč (http://martin.takac.name)
 * @license   https://opensource.org/licenses/MIT MIT
 */


namespace Taco\Nette\Controls\Table;

use Nette;


/**
 * Plain text column
 */
class TextColumn extends Nette\ComponentModel\Component implements KeyColumn
{


	/** @var string */
	private $value;

	/** @var string */
	private $header;


	/**
	 * Get label of column for head.
	 * @return string
	 */
	function getHeader()
	{
		return $this->header;
	}


	function setHeader($m)
	{
		$this->header = $m;
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
	 * Content of current column
	 */
	function getValue()
	{
		return $this->value;
	}


	/**
	 * Render cell
	 * @param mixed $record record
	 */
	function render()
	{
		echo $this->value;
	}


}
