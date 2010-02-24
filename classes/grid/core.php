<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Grid modeling library for creating data tables
 *
 * @package     Grid
 * @author      Kyle Treubig
 * @copyright   (C) 2010 Kyle Treubig
 * @license     MIT
 */
class Grid_Core {

	/** Array of table columns */
	private $columns = array();
	/** Array of action links */
	private $links = array();
	/** Table dataset */
	private $dataset = array();

	/**
	 * Add a column to the table
	 *
	 * @param   string      [optional] column type
	 * @return  Grid_Column
	 */
	public function &column($type='text') {
		$model = 'Grid_Column_' . ucfirst($type);
		$column = new $model;
		$index = count($this->columns);
		array_push($this->columns, $column);
		Kohana::$log->add(Kohana::DEBUG, 'Added '.$type.' column to grid');
		return $this->columns[$index];
	}

	/**
	 * Add an action link to the table
	 *
	 * @param   string      [optional] link type
	 * @return  Grid_Link
	 */
	public function &link($type='text') {
		$link = new Grid_Link($type);
		$index = count($this->links);
		array_push($this->links, $link);
		Kohana::$log->add(Kohana::DEBUG, 'Added '.$type.' link to grid');
		return $this->links[$index];
	}

	/**
	 * Add data to the table
	 *
	 * @param   array   collection of dataset records
	 * @return  Grid
	 */
	public function data($resource) {
		$dataset = array();
		foreach($resource as $data)
		{
			$dataset[] = $data;
		}
		array_splice($this->dataset, count($this->dataset), 0, $dataset);
		Kohana::$log->add(Kohana::DEBUG, 'Added data to grid');
		return $this;
	}

	/**
	 * Render the table as an HTML string
	 *
	 * @param   string  [optional] view file
	 * @return  string
	 */
	public function render($view = 'grid/table') {
		$view = View::factory($view);
		$view->columns = $this->columns;
		$view->links   = $this->links;
		$view->dataset = $this->dataset;
		Kohana::$log->add(Kohana::DEBUG, 'Rendering the grid');
		return $view->render();
	}

	/**
	 * Alias for Grid::render()
	 */
	public function __tostring() {
		return $this->render();
	}

}

