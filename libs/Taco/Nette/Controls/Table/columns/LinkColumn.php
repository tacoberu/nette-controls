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
	Nette\Utils,
	Nette\Utils\Validators;


/**
 * Simple link action.
 */
class LinkColumn extends BaseColumn implements RowColumn
{


	/** @var ? */
	private $link;


	/** @var ? */
	private $text;


	/** @var Utils\Html */
	private $cellPrototype;


	function __construct($link, $text)
	{
		parent::__construct();
		$this->link = $link;
		$this->text = $text;
		$this->cellPrototype = Utils\Html::el('a');
	}



	/**
	 * Render cell
	 * @param mixed $record record
	 */
	function render()
	{
		$cell = clone $this->getCellPrototype();
		$cell->href($this->buildUrl());
		$cell->setText($this->buildText());
		echo $cell;
	}



	function getCellPrototype()
	{
		return $this->cellPrototype;
	}



	function buildUrl()
	{
		if (Validators::isCallable($this->link)) {
			$fn = $this->link;
			return $fn($this->parent->presenter, $this->value);
		}
		return $this->link;
	}



	function buildText()
	{
		if (Validators::isCallable($this->text) && ! is_string($this->text)) {
			$fn = $this->text;
			return $fn($this->value);
		}
		return $this->text;
	}


}
