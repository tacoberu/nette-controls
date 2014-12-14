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
