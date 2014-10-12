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
use Nette\Application\UI\Control,
	Nette\Utils\Paginator,
	Nette\Utils\Callback;


/**
 * Simple list of items.
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



	function setValues($values)
	{
		$this->values = $values;
		if (count($this->columns)) {
			$this->columns = $this->typeCast($this->columns, $this->getRepresetationSample($values));
		}
		return $this;
	}



	function setHeader($name, $label)
	{
		//~ $this[$name]->setHeader($label);
		$this->getColumn($name, Null)->setHeader($label);
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
		//	Vzor pro pořadí sloupců.
		$headers = $this->getRepresetationSample($this->values);

		//	Definice hlaviček sloupců.
		foreach ($this->columns as $n => $col) {
			$headers[$n] = $col->getHeader();
		}

		return $headers;
	}



	/**
	 * Doplnění prototypů hlaviček. Pokud nejdříve nastavujeme hlavičky,
	 * a až pak přiřadíme data, tak se nedají typnout, jakého typu je
	 * sloupce v případě, kdy jej neurčíme explicitně.
	 *
	 * @param array $columns Pole definic sloupců.
	 * @param array $sample Vzorek dat.
	 *
	 * @return array
	 */
	function typeCast(array $columns, array $sample)
	{
		foreach ($columns as $n => $col) {
			if ($col instanceof Table\PrototypeColumn) {
				$col = $this->createColumn($n, isset($sample[$n]) ? $sample[$n] : Null, $col);
				$columns[$n] = $col;
			}
		}

		return $columns;
	}



	/**
	 * Řádky s daty.
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
	 * @return Header
	 * /
	private function _getHeader($name)
	{
		return $this->getColumn($name, Null); //->getHeader();
	}


	/**
	 * @return Column
	 */
	private function getColumn($name, $sample)
	{
		if (! isset($this->columns[$name])) {
			if ($sample == Null) {
				$this->columns[$name] = new Table\PrototypeColumn();
			}
			else {
				$this->columns[$name] = $this->createColumn($name, $sample);
			}
		}
		return $this->columns[$name];
	}



	/**
	 * @return Column
	 */
	private function createColumn($name, $sample, Table\PrototypeColumn $col = Null)
	{
		if ($sample == Null) {
			$column = new Table\TextColumn();
		}
		else if (is_string($sample) || is_scalar($sample)) {
			$column = new Table\TextColumn();
		}
		else if ($sample instanceof DateTime) {
			$column = new Table\DateTimeColumn();
		}
		else {
			throw new LogicException('Unsuported typo of content: `' . get_class($sample) . '\'.');
		}

		// Doplnit data z prototypu
		if ($col) {
			$column->setHeader($col->getHeader());
		}

		return $column;
	}




	/**
	 * Šablona pro wrapování řádek.
	 */
	private function createRowWrapping()
	{
		$res = array();
		$row = $this->getRepresetationSample($this->values);
		foreach ($row as $n => $v) {
			$res[$n] = $this->getColumn($n, $v);
		}
		return new Table\RowDecorator($res);
	}



	private function getRepresetationSample($values)
	{
		if (! $values || ! count($values)) {
			return array();
		}
		return reset($values);
	}

}
