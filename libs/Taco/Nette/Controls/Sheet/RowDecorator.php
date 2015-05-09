<?php
/**
 * Copyright (c) since 2004 Martin Takáč (http://martin.takac.name)
 * @license   https://opensource.org/licenses/MIT MIT
 */

namespace Taco\Nette\Controls\Sheet;

use LogicException,
	Traversable;


/**
 * Decore each row for assign value to cells.
 */
class RowDecorator
{


	/**
	 * @param array of Column
	 */
	private $columns;



	/**
	 * @param array of Columns $columns
	 */
	function __construct(Traversable $columns)
	{
		if (! count($columns)) {
			throw new LogicException("Count of columns is 0.");
		}
		$this->columns = $columns;
	}



	/**
	 * Decore cell by columns.
	 * @param mixed $record record
	 * @return Row
	 */
	function decore($row)
	{
		$row = (object) $row;
		$res = new Row($row);
		foreach ($this->columns as $n => $cell) {
			if ($cell instanceof KeyColumn) {
				if (property_exists($row, $n)) {
					$cell->setValue($row->$n);
				}
				elseif (method_exists($row, "get{$n}")) {
					$cell->setValue($row->{'get' . $n}());
				}
				else {
					throw new LogicException("Cell with name: `$n' not found in row: `" . get_class($row) . "'.");
				}
			}
			elseif ($cell instanceof RowColumn) {
				$cell->setRow($row);
			}
			else {
				throw new LogicException("Unsupported type of column: `" . get_class($cell) . "'.");
			}
			$res[$n] = $cell;
		}

		return $res;
	}


}
