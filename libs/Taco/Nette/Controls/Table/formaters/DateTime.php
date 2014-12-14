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


use DateTime;


/**
 * Format column with value of DateTime.
 */
class DateTimeFormater
{

	/** @var string */
	private $format = 'Y-m-d H:i:s';


	/** @var string */
	private $emptyFormat = '-';


	function __construct($format = Null, $emptyFormat = '-')
	{
		if ($format) {
			$this->format = $format;
		}
		$this->emptyFormat = $emptyFormat;
	}



	/**
	 * Format concrete value.
	 * @return String
	 */
	function __invoke(DateTime $value = Null)
	{
		if ($value) {
			return $value->format($this->format);
		}
		else {
			return $this->emptyFormat;
		}
	}



}
