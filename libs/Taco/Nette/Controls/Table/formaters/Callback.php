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


use Nette,
	Nette\Utils\Callback;


/**
 * Plain text column
 */
class CallbackFormater
{

	/** @var callback */
	private $callback;


	function __construct($callback)
	{
		Callback::check($callback);
		$this->callback = $callback;
	}



	/**
	 * Render cell
	 * @param mixed
	 */
	function format($val)
	{
		$fce = $this->callback;
		return $fce($val);
	}


}