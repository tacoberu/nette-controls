<?php
/**
 * Copyright (c) since 2004 Martin Takáč (http://martin.takac.name)
 * @license   https://opensource.org/licenses/MIT MIT
 */

namespace Taco\Nette\Controls\Table;

use Nette;
use InvalidArgumentException;


/**
 * @property mixed $value
 * @property Header $header
 * @property mixed $formater
 */
abstract class BaseColumn extends Nette\ComponentModel\Component
{


	/** @var string */
	private $value;


	/** @var string */
	private $header;


	/** @var Formater, Callback */
	private $formater;


	/** @var array of String */
	private $classes = array();


	/**
	 * Get label of column for head.
	 * @return Header
	 */
	function getHeader()
	{
		return $this->header;
	}


	function setHeader(Header $m)
	{
		$this->header = $m;
		return $this;
	}


	/**
	 * @return mixed
	 */
	function getFormater()
	{
		return $this->formater;
	}


	function setFormater($m)
	{
		$this->formater = $m;
		return $this;
	}



	/**
	 * Zda bude podle sloupce řazeno.
	 */
	function enableSort($dir = 'unused')
	{
		switch ($dir) {
			case '1':
			case 'unused':
				$m = Sorted::create($this->header);
				break;
			case 'asc':
				$m = Sorted::asc($this->header);
				break;
			case 'desc':
				$m = Sorted::desc($this->header);
				break;
			default:
				throw new InvalidArgumentException("Unsuported argument/type of order: `{$m}'.");
		}

		$this->header->sorted = $m;
		return $this;
	}



	/**
	 * Zda bude podle sloupce filtrováno.
	 */
	function enableFilter()
	{
		$this->header->filter = new Filter($this->header);
		return $this;
	}



	/**
	 * Content of current column
	 */
	function getSorted()
	{
		if (empty($this->header)) {
			return Null;
		}
		return $this->header->sorted;
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
	 * Content of current column
	 * @param string
	 */
	function setClass($m)
	{
		if ($this->hasClasses($m)) {
			return $this;
		}
		$this->classes[] = $m;
		return $this;
	}



	/**
	 * @param string
	 */
	function hasClasses($s)
	{
		return in_array($s, $this->classes);
	}



	/**
	 * Render cell
	 * @param mixed $record record
	 */
	function render()
	{
		if ($this->formater) {
			$formater = $this->formater;
			echo $formater($this->value);
		}
		else {
			echo $this->value;
		}
	}


}
