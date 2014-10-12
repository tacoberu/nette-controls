<?php

/**
 * Nette Framework Extras
 *
 * This source file is subject to the New BSD License.
 *
 * For more information please see http://addons.nette.org
 *
 * @copyright  Copyright (c) 2009 David Grudl
 * @license    New BSD License
 * @link       http://addons.nette.org
 * @package    Nette Extras
 * @author     David Grudl
 * @author     Martin Takáč
 */


namespace Taco\Nette\Controls;


use Nette\Utils\Paginator as UtilsPaginator;


/**
 * Visual paginator control.
 */
class Paginator extends BaseControl
{

	/** @var Nette\Utils\Paginator */
	private $paginator;


	/** @var array */
	private $steps;


	/** @persistent */
	public $page = 1;


	/**
	 * Set items per page
	 * @param int $itemsPerPage items per page
	 * @return PaginatorControl
	 */
	public function setItemsPerPage($itemsPerPage)
	{
		$this->getPaginator()->itemsPerPage = $itemsPerPage;
		return $this;
	}


	/**
	 * Set total items
	 * @param int $itemCount total items.
	 * @return PaginatorControl
	 */
	public function setItemCount($itemCount)
	{
		$this->getPaginator()->itemCount = $itemCount;
		return $this;
	}


	/**
	 * @return Nette\Utils\Paginator
	 */
	public function getPaginator()
	{
		if (!$this->paginator) {
			$this->paginator = new UtilsPaginator;
		}

		return $this->paginator;
	}


	/**
	 * Renders paginator.
	 * @param array $options
	 * @return void
	 */
	public function render($options = NULL)
	{
		if (NULL !== $options) {
			$paginator = $this->getPaginator();
			$paginator->setItemCount($options['count']);
			$paginator->setItemsPerPage($options['pageSize']);
		}

		$this->template->steps = $this->getSteps();
		$this->template->paginator = $this->getPaginator();

		$this->template->render();
	}


	public function getSteps()
	{
		if (empty($this->steps)) {
			$paginator = $this->getPaginator();
			$page = $paginator->page;

			if ($paginator->pageCount < 2) {
				$this->steps = array($page);
			}
			else {
				$arr = range(max($paginator->firstPage, $page - 3), min($paginator->lastPage, $page + 3));
				$count = 4;
				$quotient = ($paginator->pageCount - 1) / $count;
				for ($i = 0; $i <= $count; $i++) {
					$arr[] = round($quotient * $i) + $paginator->firstPage;
				}
				sort($arr);
				$this->steps = array_values(array_unique($arr));
			}
		}
		return $this->steps;
	}


	/**
	 * Loads state informations.
	 * @param  array
	 * @return void
	 */
	public function loadState(array $params)
	{
		parent::loadState($params);
		$this->getPaginator()->page = $this->page;
	}

}
