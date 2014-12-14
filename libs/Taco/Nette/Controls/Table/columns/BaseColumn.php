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
abstract class BaseColumn extends Nette\ComponentModel\Component
{


	/** @var string */
	private $value;


	/** @var string */
	private $header;


	/** @var Formater, Callback */
	private $formater;



	/**
	 * Get label of column for head.
	 * @return string
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
	 * @return
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
	function enableSort()
	{
		switch ($this->parent->getSortingStateFor($this)) {
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
				throw new \InvalidArgumentException("Unsuported argument/type of order: `{$m}'.");
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
