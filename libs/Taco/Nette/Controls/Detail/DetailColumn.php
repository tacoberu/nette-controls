<?php
/**
 * Copyright (c) since 2004 Martin Takáč (http://martin.takac.name)
 * @license   https://opensource.org/licenses/MIT MIT
 */

namespace Taco\Nette\Controls\Detail;

use Nette;
use Taco\Utils\Formaters\Formater;


/**
 * Element prvku.
 * @property string $label
 */
class Column extends Nette\ComponentModel\Component
{


	/**
	 * Typ prvku, string, číslo, měna, bool
	 * @var string
	 */
	private $type;


	/**
	 * Doplňující kategorizace.
	 * @var array
	 */
	private $classes = array();


	/**
	 * Hodnota prvku.
	 * @var string
	 */
	private $value;


	/**
	 * Popisek.
	 * @var string
	 */
	private $label;


	/**
	 * Defaultní formátování prvku.
	 * @var Formater, Callback
	 */
	private $formater;


	/**
	 * Constructor injection.
	 * @param string $label
	 * @param Formater $formater
	 */
	function __construct($label, Formater $formater)
	{
		$this->label = $label;
		$this->formater = $formater;
	}



	/**
	 * Get label of column for head.
	 * @return string
	 */
	function getLabel()
	{
		return $this->label;
	}



	function setLabel($m)
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
			$formater = clone $this->formater;
			$formater->setOptions(func_get_args());
			echo $formater->format($this->value);
		}
	}


}
