<?php
/**
 * Copyright (c) since 2004 Martin Takáč (http://martin.takac.name)
 * @license   https://opensource.org/licenses/MIT MIT
 */

namespace Taco\Nette\Controls;

use LogicException,
	DateTime;
use Nette\Utils\Strings;
use Taco;
use Taco\Utils\Formaters\Formater,
	Taco\Utils\Formaters\NullFormater;


/**
 * Simple table of items.
 *
 * Tabulka obsahuje n řádek který se dělý na sloupce. Sloupec má/může mít
 * krom vlastního obsahu také hlavičku a patičku.
 */
class SheetControl extends BaseControl
{

	/**
	 * @var array Zobrazovaná data.
	 */
	private $values;



	/**
	 * Přiřazení hodnot, které budeme zobrazovat.
	 * @param array|closure|Traversable
	 */
	function setValues($values)
	{
		if (is_array($values)) {
			$values = function() use ($values) { return $values; };
		}

		if (is_callable($values)) {
			$values = new Taco\Utils\LazyIterator($values);
		}

		$this->values = $values;
		return $this;
	}



	/**
	 * Pouze zde použité sloupečky se zobrazí. Ostatní data se ignorují.
	 * @param string $name Jméno sloupečku.
	 * @param string $label Popisek
	 * @param Detail\Formater $formater Konverze na string.
	 */
	function addColumn($name, $header, Formater $formater = Null)
	{
		if (empty($formater)) {
			$formater = new NullFormater();
		}
		$column = new Sheet\Column($name, $formater);
		if ($header) {
			$column->header = $header;
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
	 * Řádky s daty opatřené dekorátorem, který každé buce přiřadí její formátor.
	 *
	 * @return array of array
	 */
	function getValues()
	{
		return new Sheet\Iterator($this->values, $this->createRowWrapping());
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



	// -- PRIVATE ------------------------------------------------------



	/**
	 * Šablona pro wrapování řádek.
	 */
	private function createRowWrapping()
	{
		return new Sheet\RowDecorator($this->getComponents());
	}



}
