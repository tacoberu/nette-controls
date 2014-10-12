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
	 * ???
	 */
	function setHeader($m);


	/**
	 * Content of current column
	 * @param string
	 */
	function setValue($m);


	/**
	 * @return string
	 */
	function __toString();


}
