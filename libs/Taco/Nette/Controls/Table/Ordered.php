<?php
/**
 * Copyright (c) since 2004 Martin Takáč (http://martin.takac.name)
 * @license   https://opensource.org/licenses/MIT MIT
 */

namespace Taco\Nette\Controls\Table;

use Nette;


/**
 * Hodnota řazení.
 */
class Sorted extends Nette\Object
{

	const UNUSED = 'unused';
	const ASC = 'asc';
	const DESC = 'desc';


	private $parent;


	private $state;


	function __construct(Header $parent, $state = self::UNUSED)
	{
		$this->parent = $parent;
		$this->state = $state;
	}



	static function create($parent)
	{
		return new static($parent);
	}



	static function asc($parent)
	{
		return new static($parent, static::ASC);
	}



	static function desc($parent)
	{
		return new static($parent, static::DESC);
	}



	function getName()
	{
		return $this->parent->name;
	}



	function setState($val)
	{
		$this->state = $val;
		return $this;
	}



	function isAsc()
	{
		return $this->state == static::ASC;
	}



	function isDesc()
	{
		return $this->state == static::DESC;
	}



	function isUnused()
	{
		return $this->state == static::UNUSED;
	}


}
