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
