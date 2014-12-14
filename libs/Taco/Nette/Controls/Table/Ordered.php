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


use Nette;


/**
 * Hodnota řazení.
 */
class Sorted
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
