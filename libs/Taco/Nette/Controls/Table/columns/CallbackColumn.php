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
class CallbackColumn extends BaseColumn implements RowColumn
{


	/** @var callback */
	private $callback;


	function __construct($callback)
	{
		Callback::check($callback);
		parent::__construct();
		$this->callback = $callback;
	}


	/**
	 * Render cell
	 * @param mixed $record record
	 */
	function render()
	{
		$fce = $this->callback;
		echo $fce($this->value);
	}


}
