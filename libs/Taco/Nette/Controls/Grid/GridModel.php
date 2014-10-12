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
	 * Co je unikátní identifikátor záznamu.
	 * @param (object) $item;
	 * @return ???
	 */
//	function getUniqueId($item);


	/**
	 * @param
	 * @return Int
	 */
	function count(Filter $filter = Null);


	/**
	 * @param (object) $item;
	 * @return Iterator
	 */
	function getItems(Filter $filter = Null, OrderBy $order = Null, $limit = 20, $offset = 0);


}
