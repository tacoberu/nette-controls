<?php
/**
 * Copyright (c) since 2004 Martin Takáč (http://martin.takac.name)
 * @license   https://opensource.org/licenses/MIT MIT
 */

namespace Taco\Nette\Controls\Sheet;

use LogicException,
	Traversable,
	ArrayAccess;
use Nette\Utils\Validators;
use Nette\Utils\AssertionException;


/**
 * Decore each row for assign value to cells.
 */
class RowDecorator
{


	/**
	 * @param array of Column
	 */
	private $columns = [];



	/**
	 * @param array of Columns $columns
	 */
	function __construct(Traversable $columns)
	{
		if (! count($columns)) {
			throw new LogicException("Count of columns is 0.");
		}
		foreach ($columns as $name => $col) {
			self::assertColumn($name, $col);
			$this->columns[$name] = $col;
		}
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
				elseif ($row instanceof ArrayAccess && isset($row[$n])) {
					$cell->setValue($row[$n]);
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



	private static function assertColumn($name, $col)
	{
		Validators::assert($name, 'string:1..', 'Key of list of Column');
		if ( ! $col instanceof KeyColumn || ! $col instanceof RowColumn) {
			new AssertionException('The type of Column expects to be KeyColumn or RowColumn.');
		}
	}

}
