<?php
/**
 * Copyright (c) since 2004 Martin Takáč (http://martin.takac.name)
 * @license   https://opensource.org/licenses/MIT MIT
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
