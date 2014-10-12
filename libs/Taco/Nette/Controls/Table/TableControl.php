<?php
/**
 * Copyright (c) since 2004 Martin Takáč (http://martin.takac.name)
 * @license   https://opensource.org/licenses/MIT MIT
 */

namespace Taco\Nette\Controls;


use LogicException,
	DateTime;
use Nette\Application\UI\Control,
	Nette\Utils\Callback;


/**
 * Simple table of items.
 */
class Table extends Control
{

	/**
	 * @var string Cesta k souboru se šablonou.
	 */
	public $templateFile = Null;


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
	 * Nastavit nějakému sloupečku styl vyplnění.
	 * Pouze zde použité sloupečky se zobrazý. Ostatní data se ignorují.
	 */
	function addColumn($name, $header, $type = Null)
	{
		if (empty($type)) {
			$type = new Table\TextColumn();
		}

		if ($header) {
			$type->setHeader($header);
		}

		$this->columns[$name] = $type;

		return $this;
	}



	/**
	 * Počet sloupců.
	 * @return int
	 */
	function getCols()
	{
		return count($this->columns);
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



	/**
	 * Default render
	 */
	function render()
	{
		$this->template->values = $this->getValues();
		$this->template->cols = $this->getCols();
		$this->template->heads = $this->getHeaders();
		$this->template->render();
	}



	// -- PROTECTED ----------------------------------------------------



	/**
	 * Create template
	 * @return Template
	 */
	protected function createTemplate($class = NULL)
	{
		return parent::createTemplate()->setFile($this->templateFile ?: __DIR__ . "/table.latte");
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
