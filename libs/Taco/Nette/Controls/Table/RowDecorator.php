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


namespace Taco\Nette\Controls\Table;


use Nette;
use LogicException;


/**
 * Decore each row.
 */
class RowDecorator
{


	private $columns;


	/**
	 * Přiřazení mapy sloupců.
	 * @param array of Columns $columns
	 */
	function __construct($columns)
	{
		$this->columns = $columns;
	}



	/**
	 * Decore cell by columns.
	 * @param mixed $record record
	 */
	function decore($row)
	{
		$row = (object) $row;
		$res = array();
		foreach ($this->columns as $n => $cell) {
			if ($cell instanceof KeyColumn) {
				if (! property_exists($row, $n)) {
					throw new LogicException("Cell with name: `$n' not found in row: `" . implode(',', array_keys((array)$row)) . "'.");
				}
				$cell->setValue($row->$n);
			}
			elseif ($cell instanceof RowColumn) {
				$cell->setRow($row);
			}
			else {
				throw new LogicException("Unsupported type of column.");
			}
			$res[$n] = $cell;
		}
		return $res;
	}


}
