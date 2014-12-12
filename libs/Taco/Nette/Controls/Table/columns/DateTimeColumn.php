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
	public $format = 'Y-m-d H:i:s';


	/** @var string */
	public $emptyFormat = '-';


	function __construct($format = Null, $emptyFormat = '-')
	{
		parent::__construct();
		if ($format) {
			$this->format = $format;
		}
		$this->emptyFormat = $emptyFormat;
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
		if (! empty($m) && ! $m instanceof DateTime) {
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
		if ($this->value) {
			echo $this->value->format($this->format);
		}
		else {
			echo $this->emptyFormat;
		}
	}


}
