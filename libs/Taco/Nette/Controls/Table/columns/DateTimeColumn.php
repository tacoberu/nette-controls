<?php
/**
 * Copyright (c) since 2004 Martin Takáč (http://martin.takac.name)
 * @license   https://opensource.org/licenses/MIT MIT
 */

namespace Taco\Nette\Controls\Table;

use Nette,
	Nette\Utils;
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
	function __toString()
	{
		return (string)$this->value->format($this->format);
	}


}
