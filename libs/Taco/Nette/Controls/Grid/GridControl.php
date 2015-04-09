<?php
/**
 * Copyright (c) since 2004 Martin Takáč (http://martin.takac.name)
 * @license   https://opensource.org/licenses/MIT MIT
 */

namespace Taco\Nette\Controls;

use LogicException,
	DateTime;
use Taco\Utils\LazyIterator;


/**
 * Simple table of items.
 */
class Grid extends BaseControl
{

	const ITEMS_PER_PAGE = 20;


	/**
	 * @var ?
	 */
	private $filter = array();


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
	function setItemsPerPage($itemsPerPage)
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
		return $this['table']->addColumn($name, $header, $type);
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
			return $that->values->getItems($this->getFilter(), $this->getOrder(), $that['paginator']->paginator->getLength(), $that['paginator']->paginator->getOffset());
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
	 * Vytvoření filtrovacích podmínek.
	 */
	private function getFilter()
	{
		return $this->filter;
	}



	/**
	 * Získání řadících podmínek.
	 * @return [ <column> => 'asc|desc']
	 */
	private function getOrder()
	{
		$list = array();
		foreach ($this['table']->getComponents(False, 'Taco\Nette\controls\Table\BaseColumn') as $m) {
			if ($m->getSorted()) {
				if ($m->getSorted()->isAsc()) {
					$list[$m->name] = Grid\Model::ASC;
				}
				elseif ($m->getSorted()->isDesc()) {
					$list[$m->name] = Grid\Model::DESC;
				}
			}
		}
		return $list;
	}



	/**
	 * Šablona pro wrapování řádek.
	 */
	private function createRowWrapping()
	{
		return new Table\RowDecorator($this->columns);
	}



}
