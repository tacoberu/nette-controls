<?php
/**
 * Copyright (c) since 2004 Martin Takáč (http://martin.takac.name)
 * @license   https://opensource.org/licenses/MIT MIT
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
