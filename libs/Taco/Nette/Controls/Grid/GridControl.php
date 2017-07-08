<?php
/**
 * Copyright (c) since 2004 Martin Takáč (http://martin.takac.name)
 * @license   https://opensource.org/licenses/MIT MIT
 */

namespace Taco\Nette\Controls;

use LogicException,
	DateTime;
use Taco\Utils\LazyIterator;
use Nette\Application\UI\Control,
	Nette\Utils\Callback;

/**
 * Simple table of items.
 */
class Grid extends Control
{

	const ITEMS_PER_PAGE = 20;


	/**
	 * @var string Cesta k souboru se šablonou.
	 */
	public $templateFile = Null;


	/**
	 * @var Model Zobrazovaná data.
	 */
	private $values;



	/**
	 * @var Model Zobrazovaná data.
	 */
	private $itemsPerPage = self::ITEMS_PER_PAGE;



	/**
	 * Přiřazení hodnot, které budeme zobrazovat.
	 */
	function setValues(Grid\Model $values)
	{
		$this->values = $values;
		return $this;
	}



	/**
	 * Set items per page
	 * @param int $itemsPerPage items per page
	 * @return Grid
	 */
	public function setItemsPerPage($itemsPerPage)
	{
		$this->itemsPerPage = $itemsPerPage;
		return $this;
	}



	/**
	 * Nastavit nějakému sloupečku styl vyplnění.
	 * Pouze zde použité sloupečky se zobrazý. Ostatní data se ignorují.
	 */
	function addColumn($name, $header, $type = Null)
	{
		$this['table']->addColumn($name, $header, $type);
		return $this;
	}



	/**
	 * Default render
	 */
	function render()
	{
		$this->template->render();
	}



	// -- PROTECTED ----------------------------------------------------



	/**
	 * Create template
	 * @return Template
	 */
	protected function createTemplate($class = NULL)
	{
		return parent::createTemplate()->setFile($this->templateFile ?: __DIR__ . "/grid.latte");
	}



	/**
	 * Component factory.
	 * @see Nette/ComponentContainer#createComponent()
	 */
	protected function createComponentTable($name)
	{
		$c = new Table($this, $name);
		$that = $this;
		$c->values = new LazyIterator(function() use ($that) {
			return $that->values->getItems(Null, NUll, $that['paginator']->paginator->getLength(), $that['paginator']->paginator->getOffset());
		});
		return $c;
	}


	/**
	 * Component factory.
	 * @see Nette/ComponentContainer#createComponent()
	 */
	protected function createComponentPaginator($name)
	{
		$c = new VisualPaginator($this, $name);
		$c->paginator->itemsPerPage = $this->itemsPerPage;
		$c->paginator->itemCount = $this->values->count();
		return $c;
	}



	// -- PRIVATE ------------------------------------------------------



	/**
	 * Šablona pro wrapování řádek.
	 */
	private function createRowWrapping()
	{
		return new Table\RowDecorator($this->columns);
	}



}
