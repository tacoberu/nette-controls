<?php
/**
 * Copyright (c) since 2004 Martin Takáč (http://martin.takac.name)
 * @license   https://opensource.org/licenses/MIT MIT
 */

namespace Taco\Nette\Controls\Table;

use Nette;


/**
 * Hlavička sloupce. Může obsahovat řazení.
 */
class Header extends Nette\Object
{

	/** @var string */
	private $label;


	/** @var ? */
	private $parent;


	/** @var Sorted */
	private $sorted;


	/** @var Filter */
	private $filter;


	/** @var Formater, Callback */
	public $formater;


	function __construct($parent, $label)
	{
		$this->parent = $parent;
		$this->label = $label;
	}



	function getName()
	{
		return $this->parent->name;
	}



	function setSorted(Sorted $m)
	{
		$this->sorted = $m;
		return $this;
	}



	function getSorted()
	{
		return $this->sorted;
	}



	function setFilter(Filter $m)
	{
		$this->filter = $m;
		return $this;
	}



	function getFilter()
	{
		return $this->filter;
	}



	/**
	 * Render cell
	 * @return String
	 */
	function __toString()
	{
		if ($this->formater) {
			$formater = $this->formater;
			return $formater($this->label, $this->sorted);
		}
		else {
			return $this->label;
		}
	}


}
