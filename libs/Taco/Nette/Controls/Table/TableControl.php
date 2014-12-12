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
	 * Přiřazení hodnot, které budeme zobrazovat.
	 */
	function setValues($values)
	{
		$this->values = $values;
		return $this;
	}



	/**
	 * Přiřadí nějaký sloupec.
	 *
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

		$this->addComponent($type, $name);
		return $this[$name];
	}



	/**
	 * Počet sloupců.
	 * @return int
	 */
	function getCols()
	{
		return count($this->getComponents());
	}



	/**
	 * Definice hlaviček.
	 * @return array
	 */
	function getHeaders()
	{
		$headers = array();
		foreach ($this->getComponents() as $n => $col) {
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



	/**
	 * Default render
	 */
	function render()
	{
		$this->template->values = $this->getValues();
		$this->template->cols = $this->getCols();
		$this->template->headers = $this->getHeaders();
		$this->template->render();
	}



	// -- PROTECTED ----------------------------------------------------



	// -- PRIVATE ------------------------------------------------------



	/**
	 * Šablona pro wrapování řádek.
	 */
	private function createRowWrapping()
	{
		return new Table\RowDecorator($this->getComponents());
	}



}
