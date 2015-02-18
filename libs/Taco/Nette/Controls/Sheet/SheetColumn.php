<?php
/**
 * Copyright (c) since 2004 Martin Takáč (http://martin.takac.name)
 * @license   https://opensource.org/licenses/MIT MIT
 */

namespace Taco\Nette\Controls\Sheet;

use Nette;
use Taco\Utils\Formaters\Formater;
use Exception;

/**
 * ?
 */
class Column extends Nette\ComponentModel\Component implements KeyColumn
{


	/** @var string */
	private $value;


	/** @var string */
	private $header;


	/** @var Formater, Callback */
	private $formater;


	/**
	 * Constructor injection.
	 * @param string $label
	 * @param Formater $formater
	 */
	function __construct($label, Formater $formater)
	{
		$this->header = $label;
		$this->formater = $formater;
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
	 * @return string
	 */
	function __toString()
	{
		try {
			if ($this->formater) {
				$formater = clone $this->formater;
				$formater->setOptions(func_get_args());
				return (string)$formater->format($this->value);
			}
			return '';
		}
		catch (Exception $e) {
			return "Invalid format of value with error: `{$e->getMessage()}'.";
		}
	}



	/**
	 * Render cell
	 * @param mixed $record record
	 */
	function render()
	{
		echo (string)$this;
	}


}
