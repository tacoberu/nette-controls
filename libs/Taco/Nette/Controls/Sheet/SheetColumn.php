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
 * Jedna buňka výsledku. Je samovykrslitelná ale obsahuje i dodatečné informace
 * pro formátování a podobně.
 */
class Column extends Nette\ComponentModel\Component implements KeyColumn
{


	/** @var string */
	private $value;


	/** @var string */
	private $header;


	/** @var Formater, Callback */
	private $formater;


	/** @var arr */
	private $attrs = array();


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
	 * Attribute of current column.
	 *
	 * @param array $values Example ['class'=>'text-center', 'data-type'=> 'datepicker']
	 */
	function setCellAttributes(array $values)
	{
		$this->attrs = $values;
		return $this;
	}



	/**
	 * Attribute of current column.
	 *
	 * @param string $name Example 'class', 'data-type'
	 * @param string $value Example 'text-center', 'datepicker'
	 */
	function setCellAttribute($name, $value)
	{
		$this->attrs[$name] = $value;
		return $this;
	}



	/**
	 * Attribute of current column.
	 */
	function getCellAttributes()
	{
		return $this->attrs;
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
