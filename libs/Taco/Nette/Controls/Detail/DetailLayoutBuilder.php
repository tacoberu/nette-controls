<?php
/**
 * Copyright (c) since 2004 Martin Takáč (http://martin.takac.name)
 * @license   https://opensource.org/licenses/MIT MIT
 */

namespace Taco\Nette\Controls;

use Nette\Utils;
use Taco\Utils\Formaters\NullFormater,
	Taco\Utils\Formaters\ClosureFormater;
use RuntimeException;


/**
 * Vytvoření hrubého detailu nějaké entity. Pro každý datový prvek, který
 * nelze převést na text je vyžadován nějaký formater.
 */
class DetailLayoutBuilder
{


	/**
	 * Seznam formáterů použitých na konkrétní typy hodnot.
	 */
	private $formaters = array();


	/**
	 * Formater is tool for convert object to string
	 * @param string
	 * @param Formater|closure $formater
	 */
	function addFormater($name, $formater)
	{
		if (is_callable($formater)) {
			$formater = new ClosureFormater($formater);
		}
		$this->formaters[$name] = $formater;
		return $this;
	}



	/**
	 * Formulář pro nový záznam.
	 *
	 * @param array | object Pro který se vytvářejí controls.
	 *
	 * @return BaseForm
	 */
	function create($entry)
	{
		// Vytáhnout klíče a hodnoty z objektu
		if (is_object($entry)) {
			$values = array();
			// Getters
			foreach (get_class_methods($entry) as $name) {
				if (! in_array($name, array('getReflection')) && Utils\Strings::startsWith($name, 'get')) {
					$k = strtolower(substr($name, 3));
					$values[$k] = $entry->$name();
				}
			}
			// Public fields
			foreach (get_object_vars($entry) as $k => $v) {
				$values[$k] = $v;
			}
		}
		else {
			$values = $entry;
		}

		$control = new DetailControl();
		foreach ($values as $k => $val) {
			$control->addColumn($k, self::formatLabel($k), $this->lookupFormater($val));
		}

		$control->values = $values;

		return $control;
	}



	/**
	 * Hledáme jej podle typu hodnoty.
	 *
	 * @param mixin
	 *
	 * @return Formater
	 */
	private function lookupFormater($val)
	{
		if (is_object($val) && isset($this->formaters[get_class($val)])) {
			$fn = $this->formaters[get_class($val)];
			return $fn;
		}

		// Vyhledání nepřímích předků.
		foreach ($this->formaters as $name => $fn) {
			if ($val instanceof $name) {
				return $fn;
			}
		}

		if ( ! is_object($val) || method_exists($val, '__toString')) {
			return new NullFormater();
		}

		throw new RuntimeException("Cannot convert `" . $val . "' to string.");
	}



	/**
	 * @return string
	 */
	private static function formatLabel($k)
	{
		return $k;
	}


}
