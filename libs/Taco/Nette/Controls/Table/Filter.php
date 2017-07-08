<?php
/**
 * Copyright (c) since 2004 Martin Takáč (http://martin.takac.name)
 * @license   https://opensource.org/licenses/MIT MIT
 */

namespace Taco\Nette\Controls\Table;

use Nette,
	Nette\Utils\Html;


/**
 * Filtrování sloupce.
 */
class Filter extends Nette\Object
{

	/** @var Header */
	private $parent;


	/** @var string */
	private $value;


	function __construct(Header $parent)
	{
		$this->parent = $parent;
	}



	function getName()
	{
		return $this->parent->name;
	}



	function setValue($value)
	{
		$this->value = $value;
		return $this;
	}



	function getValue()
	{
		return $this->value;
	}



	/**
	 * Render cell
	 * @param array $opts Setting of input.
	 */
	function render(array $opts = array())
	{
		echo Html::el('input', array_merge(array(
			'name' => $this->getName(),
			'value' => $this->getValue(),
			'type' => 'text',
		), $opts));
	}


}
