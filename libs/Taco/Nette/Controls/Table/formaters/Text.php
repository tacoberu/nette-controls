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
