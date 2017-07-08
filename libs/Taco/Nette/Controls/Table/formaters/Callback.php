<?php
/**
 * Copyright (c) since 2004 Martin Takáč (http://martin.takac.name)
 * @license   https://opensource.org/licenses/MIT MIT
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
