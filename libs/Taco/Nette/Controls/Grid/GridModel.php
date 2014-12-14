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

namespace Taco\Nette\Controls\Grid;


use Countable;


/**
 * Data model
 */
interface Model extends Countable
{
	const ASC = 'asc';
	const DESC = 'desc';


	/**
	 * @param
	 * @return Int
	 */
	function count(array $filter = Null);


	/**
	 * @param (object) $item;
	 * @return Iterator
	 */
	function getItems(array $filter = Null, array $order = array(), $limit = 20, $offset = 0);


}
