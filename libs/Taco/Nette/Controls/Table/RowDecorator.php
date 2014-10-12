<?php
/**
 * Copyright (c) since 2004 Martin Takáč (http://martin.takac.name)
 * @license   https://opensource.org/licenses/MIT MIT
 */

namespace Taco\Nette\Controls\Table;

use Nette;
use LogicException,
	Traversable;


/**
 * Plain text column
 */
class RowDecorator
{


	private $columns;


	/**
	 * --
	 */
	function __construct(array $columns)
	{
		$this->columns = $columns;
	}



	/**
	 * Render cell
	 * @param mixed $record record
	 */
	function decore($row)
	{
		$res = array();
		foreach ($this->columns as $n => $cell) {
			if ($cell instanceof KeyColumn) {
				if (!isset($row[$n])) {
					throw new LogicException("Cell with name: `$n' not found in row: `" . implode(',', array_keys($row)) . "'.");
				}
				$cell->setValue($row[$n]);
			}
			elseif ($cell instanceof CompositeColumn) {
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
