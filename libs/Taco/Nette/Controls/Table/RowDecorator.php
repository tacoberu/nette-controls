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
 * Plain text column
 */
class RowDecorator
{


	private $columns;


	/**
	 * --
	 */
	public function __construct(array $columns)
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
