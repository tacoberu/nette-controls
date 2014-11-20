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

namespace Taco\Nette\Controls;


use LogicException,
	DateTime;
use Taco\Utils\LazyIterator;
use Nette\Utils\Callback;


/**
 * Simple table of items.
 */
class Grid extends BaseControl
{

	const ITEMS_PER_PAGE = 20;


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
	 * Nastavit nějakému sloupečku styl vyplnění.
	 * Pouze zde použité sloupečky se zobrazý. Ostatní data se ignorují.
	 */
	function addAction($action)
	{
		$this['table']->addAction($action);
		return $this;
	}



	// -- PROTECTED ----------------------------------------------------



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
		$c = new Paginator($this, $name);
		$c->itemsPerPage = $this->itemsPerPage;
		$c->itemCount = $this->values->count();
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
