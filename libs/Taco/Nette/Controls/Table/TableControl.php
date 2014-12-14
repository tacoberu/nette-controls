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
use Nette\Utils\Strings;


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
	 * @var string
	 * @persistent
	 */
	public $sort = null;


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
	 * @param Table\Column $column Implementace sloupce.
	 *
	 * @return Table\Column
	 */
	function addColumn($name, $header, $column = Null)
	{
		if (empty($column)) {
			$column = new Table\TextColumn();
		}

		if ($header) {
			$column->setHeader(new Table\Header($column, $header));
		}

		$this->addComponent($column, $name);
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
	 * Definice hlaviček.
	 * @return array
	 */
	function getFilters()
	{
		$used = False;
		$headers = array();
		foreach ($this->getComponents() as $n => $col) {
			if ($filter = $col->header->filter) {
				$used = True;
			}
			$headers[$n] = $filter;
		}

		if ($used) {
			return $headers;
		}
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



	function handleSort($column, $dir)
	{
		$map = $this->sort ? explode('|', $this->sort) : array();

		//	vyfiltrovat právě měněný.
		$map = array_filter($map, function($m) use ($column) {
			return trim($m, '-') != $column;
		});

		//	nastavit mu správnou hodnotu
		switch (strtolower($dir)) {
			case 'asc':
				$map[] = $column . '-';
				break;
			case 'desc':
				$map[] = $column;
				break;
			default:
				break;
		}
		$this->sort = implode('|', $map);
		$this->redirect('this');
	}



	function getSortingStateFor($column)
	{
		foreach ($this->sort ? explode('|', $this->sort) : array() as $m) {
			if ($column->name == $m) {
				return 'desc';
			}
			elseif (Strings::endsWith($m, '-')) {
				if (trim($m, '-') == $column->name) {
					return 'asc';
				}
			}
		}
		return 'unused';
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
