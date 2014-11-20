<?php
/**
 * Copyright (c) since 2004 Martin Takáč (http://martin.takac.name)
 * @license   https://opensource.org/licenses/MIT MIT
 */

namespace Taco\Nette\Controls;


use LogicException,
	DateTime;
use Nette\Utils\Callback;


/**
 * Simple table of items.
 *
 * Tabulka obsahuje n řádek který se dělý na sloupce. Sloupec má/může mít
 * krom vlastního obsahu také hlavičku a patičku.
 */
class Table extends BaseControl
{

	/**
	 * @var array Zobrazovaná data.
	 */
	private $values;


	/**
	 * @var array Formátování jednotlivých buněk, sloupců, patiček.
	 */
	private $columns = array();



	/**
	 * @var array Akce umístěné jako poslední sloupec.
	 */
	private $actions = array();



	/**
	 * Přiřazení hodnot, které budeme zobrazovat.
	 */
	function setValues($values)
	{
		$this->values = $values;
		return $this;
	}



	/**
	 * @param string $name Jedinečné jméno sloupce.
	 * @param string $header Titulek sloupce.
	 * @param Table\Column $type Implementace sloupce.
	 */
	function addColumn($name, $header, Table\Column $type = Null)
	{
		if (empty($type)) {
			$type = new Table\TextColumn();
		}

		if ($header) {
			$type->setHeader($header);
		}

		$type->parent = $this;
		$this->columns[$name] = $type;

		return $this;
	}



	/**
	 * Nastavit nějakému sloupečku styl vyplnění.
	 * Pouze zde použité sloupečky se zobrazý. Ostatní data se ignorují.
	 */
	function addAction(Table\Action $action)
	{
		$action->parent = $this;
		$this->actions[] = $action;

		return $this;
	}



	/**
	 * Počet sloupců.
	 * @return int
	 */
	function getCols()
	{
		return count($this->columns)
			+ count($this->actions);
	}



	/**
	 * Definice hlaviček.
	 * @return array
	 */
	function getHeaders()
	{
		$headers = array();
		foreach ($this->columns as $n => $col) {
			$headers[$n] = $col->getHeader();
		}

		return $headers;
	}



	/**
	 * Řádky s daty opatřené dekorátorem, který každé buce přiřadí její formátor.
	 *
	 * @return array of array
	 */
	function getValues()
	{
		return new Table\Iterator($this->values, $this->createRowWrapping());
	}



	function hasActions()
	{
		return (bool)$this->actions;
	}


	/**
	 * Default render
	 */
	function render()
	{
		$this->template->values = $this->getValues();
		$this->template->cols = $this->getCols();
		$this->template->headers = $this->getHeaders();
		$this->template->hasActions = $this->hasActions();
		$this->template->render();
	}



	// -- PROTECTED ----------------------------------------------------



	// -- PRIVATE ------------------------------------------------------



	/**
	 * Šablona pro wrapování řádek.
	 */
	private function createRowWrapping()
	{
		return new Table\RowDecorator($this->columns);
	}



}
