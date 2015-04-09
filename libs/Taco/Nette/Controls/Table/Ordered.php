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


	/**
	 * Vazba na definici sloupce.
	 */
	private $parent;


	private $state;


	private $defaultState;


	function __construct(Header $parent, $state = self::UNUSED)
	{
		$this->parent = $parent;
		$this->defaultState = $this->state = $state;
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
		if (!in_array($val, array(self::UNUSED, self::ASC, self::DESC))) {
			throw new DomainsException("value `{$val}' is not in domain type");
		}
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



	/**
	 * Sloupec neurčen, to je ale jen jedna ze tří možností řazení, nikoliv neřazeno.
	 */
	function isUnused()
	{
		return $this->state == static::UNUSED;
	}



	/**
	 * Jaký je další volba záleží od toho, jaká je defaultní.
	 * Normálně je default=unused, což znamená, že nepoužitost v url znamená
	 * unused. Pokud je ale default=DESC, tak v url nepoužitost znamená DESC
	 * a použitost, bez příznaku znamená unused a s příznakem znamená ASC
	 */
	function getUpState()
	{
		switch ($this->defaultState) {
			case static::UNUSED:
				return static::ASC;
			case static::ASC:
				return static::DESC;
			case static::DESC:
				return static::UNUSED;
		}
	}


	/**
	 * Jaký je další volba záleží od toho, jaká je defaultní.
	 */
	function getDownState()
	{
		switch ($this->defaultState) {
			case static::UNUSED:
				return static::DESC;
			case static::ASC:
				return static::UNUSED;
			case static::DESC:
				return static::ASC;
		}
	}



	function getDefaultState()
	{
		return $this->defaultState;
	}

}
