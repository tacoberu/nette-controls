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
class CallbackColumn extends Nette\Application\UI\Control implements CompositeColumn
{


	/** @var string */
	private $row;


	/** @var string|callback */
	private $header;


	/** @var callback */
	private $callback;


	function __construct($callback)
	{
		Callback::check($callback);
		parent::__construct();
		$this->callback = $callback;
	}


	/**
	 * Get label of column for head.
	 * @return string
	 */
	function getHeader()
	{
		return $this->header;
	}


	function setHeader($m)
	{
		$this->header = $m;
		return $this;
	}


	/**
	 * Content of current column
	 * @param string
	 */
	function setRow($m)
	{
		$this->row = $m;
		return $this;
	}


	/**
	 * Render cell
	 * @param mixed $record record
	 */
	function __toString()
	{
		$fce = $this->callback;
		return (string)$fce($this->row);
	}


}
