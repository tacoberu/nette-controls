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
use InvalidArgumentException,
	DateTime;


/**
 * Format column with DateTime
 */
class DateTimeColumn extends Nette\ComponentModel\Component implements KeyColumn
{


	/** @var string */
	private $value;


	/** @var string */
	private $header;


	/** @var string */
	private $format = 'Y-m-d H:i:s';


	function __construct($format = Null)
	{
		parent::__construct();
		if ($format) {
			$this->format = $format;
		}
	}


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
		if (! $m instanceof DateTime) {
			throw new InvalidArgumentException("Argument must be type of DateTime.");
		}
		$this->value = $m;
		return $this;
	}


	/**
	 * Render cell
	 * @param mixed $record record
	 */
	function render()
	{
		echo $this->value->format($this->format);
	}


}
