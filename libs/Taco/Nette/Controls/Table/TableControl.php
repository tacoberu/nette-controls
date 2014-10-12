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
use Nette\Utils\Callback;


/**
 * Simple table of items.
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

		$type->parent = $this;
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
		return new Table\RowDecorator($this->columns);
	}



}
