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
		$layout = strtolower(get_class($this));
		if ($i = strrpos($layout, '\\')) {
			$layout = substr($layout, $i + 1);
		}

		$presenter = $this->presenter;
		$name = $presenter->getName();
		$dir = dirname($presenter->getReflection()->getFileName());
		$dir = is_dir("$dir/templates") ? $dir : dirname($dir);
		$list = array(
			$this->templateFile,
			"$dir/templates/components/$layout.latte",
			"$dir/templates/@$layout.latte",
		);
		foreach ($list as $m) {
			if (file_exists($m)) {
				$file = $m;
				break;
			}
		}

		if (! isset($file)) {
			$dir = dirname($this->getReflection()->getFileName());
			$file = "$dir/$layout.latte";
		}

		return parent::createTemplate()->setFile($file);
	}



}
