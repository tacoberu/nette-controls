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


use Nette,
	Nette\Utils;
use InvalidArgumentException,
	DateTime;


/**
 * Format column with DateTime
 */
class DateTimeColumn extends BaseColumn implements KeyColumn
{


	function __construct($format = Null, $emptyFormat = '-')
	{
		$this->formater = new DateTimeFormater($format, $emptyFormat);
	}


}
