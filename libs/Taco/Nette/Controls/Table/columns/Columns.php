<?php
/**
 * Copyright (c) since 2004 Martin Takáč (http://martin.takac.name)
 * @license   https://opensource.org/licenses/MIT MIT
 */

namespace Taco\Nette\Controls\Table;


/**
 * Table column
 */
interface Column
{

	/**
	 * Get label of column for head.
	 * @return string
	 */
	function getHeader();


	/**
	 * Set label of column for head.
	 * @param string
	 */
	function setHeader(Header $m);



	/**
	 * @output string
	 */
	function render();


}



/**
 * Dostane hodnotu konkrétního klíče.
 */
interface Orderable
{
	/**
	 * Set ordereable of column
	 * @param ??
	 */
	function setOrdered($m);

}



/**
 * Dostane hodnotu konkrétního klíče.
 */
interface KeyColumn extends Column
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
interface RowColumn extends Column
{
	/**
	 * Content of current row
	 * @param array
	 */
	function setValue($m);

}
