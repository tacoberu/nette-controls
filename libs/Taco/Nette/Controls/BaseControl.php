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
use Nette\Application\UI\Control,
	Nette\Utils\Strings,
	Nette\Utils\Callback;


/**
 * Base control with:
 * - find template in default paths
 * - self renderable
 */
class BaseControl extends Control
{

	/**
	 * @var string Cesta k souboru se šablonou.
	 */
	public $templateFile = Null;



	/**
	 * Default render
	 */
	function render()
	{
		$this->template->render();
	}



	// -- PROTECTED ----------------------------------------------------



	/**
	 * Create template
	 * @return Template
	 */
	protected function createTemplate()
	{
		$layout = get_class($this);
		if ($i = strrpos($layout, '\\')) {
			$layout = substr($layout, $i + 1);
		}
		$layout = lcfirst($layout);
		$layout1 = strtolower($layout);

		$presenter = $this->presenter;
		$name = $presenter->getName();
		$dir = dirname($presenter->getReflection()->getFileName());
		$dir = is_dir("$dir/templates") ? $dir : dirname($dir);
		$list = array(
			$this->templateFile,
			"$dir/templates/components/$layout.latte",
			"$dir/templates/@$layout.latte",
			"$dir/templates/components/$layout1.latte",
			"$dir/templates/@$layout1.latte",
		);

		// Bez koncového control
		if (Strings::endsWith($layout, 'Control')) {
			$layout2 = lcfirst(substr($layout, 0, -7));
			$list[] = "$dir/templates/components/$layout2.latte";
			$list[] = "$dir/templates/@$layout2.latte";
		}

		// Najít
		foreach ($list as $m) {
			if (file_exists($m)) {
				$file = $m;
				break;
			}
		}

		if (! isset($file)) {
			$dir = dirname($this->getReflection()->getFileName());
			$list = array();
			$list[] = "$dir/$layout.latte";
			$list[] = "$dir/$layout1.latte";
			if (isset($layout2)) {
				$list[] = "$dir/$layout2.latte";
			}
			foreach ($list as $file) {
				if (file_exists($file)) {
					break;
				}
			}
		}

		return parent::createTemplate()->setFile($file);
	}



}
