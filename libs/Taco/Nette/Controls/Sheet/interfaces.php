<?php
/**
 * Copyright (c) since 2004 Martin Takáč (http://martin.takac.name)
 * @license   https://opensource.org/licenses/MIT MIT
 */

namespace Taco\Nette\Controls\Sheet;


/**
 * Dostane hodnotu konkrétního klíče.
 */
interface KeyColumn
{
	/**
	 * Content of current column
	 * @param string
	 */
	function setValue($m);

}



/**
 * Dostane hodnotu celého řádku.
 */
interface RowColumn
{
	/**
	 * Content of current row
	 * @param array
	 */
	function setRow($m);

}
