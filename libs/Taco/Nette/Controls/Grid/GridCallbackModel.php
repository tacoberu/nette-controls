<?php
/**
 * Copyright (c) since 2004 Martin Takáč (http://martin.takac.name)
 * @license   https://opensource.org/licenses/MIT MIT
 */

namespace Taco\Nette\Controls\Grid;


/**
 * Data model
 */
class CallbackModel implements Model
{


	private $countCallback;


	private $getItemsCallback;


	public function __construct($countCallback, $getItemsCallback)
	{
		$this->countCallback = $countCallback;
		$this->getItemsCallback = $getItemsCallback;
	}


	/**
	 * @param
	 * @return Int
	 */
	function count(Filter $filter = Null)
	{
		$fce = $this->countCallback;
		return $fce($filter);
	}


	/**
	 * @param (object) $item;
	 * @return Iterator
	 */
	function getItems(Filter $filter = Null, OrderBy $order = Null, $limit = 20, $offset = 0)
	{
		$fce = $this->getItemsCallback;
		return $fce($filter, $order, $limit, $offset);
	}


}
