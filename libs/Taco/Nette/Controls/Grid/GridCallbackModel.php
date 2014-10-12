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
