<?php
/**
 * Copyright (c) since 2004 Martin Takáč (http://martin.takac.name)
 * @license   https://opensource.org/licenses/MIT MIT
 */

namespace Taco\Nette\Controls;

use Taco\Utils\Formaters\Formater,
	Taco\Utils\Formaters\NullFormater;


/**
 * Komponenta pro základní zobrazení objektu. Funguje podobným způsobem
 * jako zobrazuje formulář formulářové prvky.
 */
class DetailControl extends BaseControl
{


	/**
	 * Pouze zde použité sloupečky se zobrazí. Ostatní data se ignorují.
	 * @param string $name Jméno sloupečku.
	 * @param string $label Popisek
	 * @param Detail\Formater $formater Konverze na string.
	 */
	function addColumn($name, $label, Formater $formater = Null)
	{
		if (empty($formater)) {
			$formater = new NullFormater();
		}
		$column = new Detail\Column($name, $formater);
		$column->setLabel($label);
		$this->addComponent($column, $name);
		return $this[$name];
	}


	/**
	 * Přiřazení hodnot.
	 */
	function setValues($values)
	{
		foreach ($values as $k => $v) {
			$this[$k]->setValue($v);
		}
	}



	function isAnchored()
	{
		return true;
	}

}
