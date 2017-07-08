<?php
/**
 * Copyright (c) since 2004 Martin Takáč (http://martin.takac.name)
 * @license   https://opensource.org/licenses/MIT MIT
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
