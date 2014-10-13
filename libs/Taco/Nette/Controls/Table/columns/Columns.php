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
	 * ???
	 */
	function setHeader($m);


	/**
	 * @return string
	 */
	function render();


}



interface KeyColumn extends Column
{
	/**
	 * Content of current column
	 * @param string
	 */
	function setValue($m);

}


interface CompositeColumn extends Column
{
	/**
	 * Content of current row
	 * @param array
	 */
	function setRow($m);

}
