<?php
/**
 * Copyright (c) since 2004 Martin Takáč (http://martin.takac.name)
 * @license   https://opensource.org/licenses/MIT MIT
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


	/**
	 * @param string $url 'detail'
	 * @param string $id 'id'
	 * @return self
	 */
	static function plink($url, $id = 'id')
	{
		return new self(function($presenter, $row) use ($url, $id) {
				return $presenter->link($url, $row->$id);
			});
	}



	function __construct($link, $text = Null)
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
		return $this->text ? $this->text : $this->header->label;
	}


}
