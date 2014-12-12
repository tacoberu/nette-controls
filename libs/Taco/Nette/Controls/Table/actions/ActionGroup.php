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
 * Group of action.
 */
class ActionGroup extends Nette\ComponentModel\Container implements Action
{

	/** @var stdClass */
	private $row;


	/** @var string|callback */
	private $header;


	/**
	 * Get label of column for head.
	 * @return string
	 */
	function getHeader()
	{
		return $this->header;
	}



	/**
	 * Set label of column for head.
	 * @param string | NULL
	 */
	function setHeader($m)
	{
		$this->header = $m;
		return $this;
	}



	/**
	 * Přiřadí nějaký sloupec.
	 *
	 * @param string $name Jedinečné jméno sloupce.
	 * @param callback $linkRenderer Funkce pro vygenerování odkazu.
	 */
	function addAction($label, $linkRenderer)
	{
		$cell = new LinkAction($linkRenderer, $label);
		return $this->addComponent($cell, strtolower($label));
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
	 * @return Presenter
	 */
	function getPresenter()
	{
		return $this->parent->presenter;
	}



	/**
	 * Render cell
	 * @param mixed $record record
	 */
	function render()
	{
		foreach ($this->getComponents() as $cell) {
			$cell->setRow($this->row);
			$cell->render();
			echo '&nbsp';
		}
	}




}
