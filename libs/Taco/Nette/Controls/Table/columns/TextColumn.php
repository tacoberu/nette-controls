<?php
/**
 * Copyright (c) since 2004 Martin Takáč (http://martin.takac.name)
 * @license   https://opensource.org/licenses/MIT MIT
 */

namespace Taco\Nette\Controls\Table;

use Nette;


/**
 * Plain text column
 */
class TextColumn extends BaseColumn implements KeyColumn
{

	/** @var string */
	private $mask;


	/**
	 * @param $mask = '%{value}'
	 */
	function __construct($mask = '%{value}')
	{
		parent::__construct();
		if ($mask != '%{value}') {
			$this->formater = function($value) use ($mask) {
				return strtr($mask, ['%{value}' => $value]);
			};
		}
	}


}
