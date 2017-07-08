<?php
/**
 * Copyright (c) since 2004 Martin Takáč (http://martin.takac.name)
 * @license   https://opensource.org/licenses/MIT MIT
 */

namespace Taco\Nette\Controls\Table;


/**
 * Format column with value of DateTime.
 */
class TextFormater
{

	/** @var Formater, Callback */
	private $formater;


	function __construct($formater = Null)
	{
		if ($formater) {
			$this->formater = $formater;
		}
	}



	/**
	 * Format concrete value.
	 * @return String
	 */
	function format($value = Null)
	{
		if ($this->formater) {
			$formater = $this->formater;
			return $formater($value);
		}
		else {
			return $value;
		}
	}



}
