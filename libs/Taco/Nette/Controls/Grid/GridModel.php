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
	 * @param
	 * @return Int
	 */
	function count(array $filter = Null);


	/**
	 * @param (object) $item;
	 * @return Iterator
	 */
	function getItems(array $filter = array(), array $order = array(), $limit = 20, $offset = 0);


}
