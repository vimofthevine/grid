<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Grid column model base class
 *
 * @package     Grid
 * @author      Kyle Treubig
 * @copyright   (C) 2010 Kyle Treubig
 * @license     MIT
 */
abstract class Grid_Column {

	/**
	 * @var string  dataset record field
	 */
	public $field;

	/**
	 * @var string  column title
	 */
	public $title;

	/**
	 * Magic call method to set variable member when
	 * variable method is called
	 *
	 * @param   string      variable name
	 * @param   string      variable value
	 * @return  Grid_Column
	 */
	public function __call($name, $value) {
		if ((isset($this->$name)) OR ($this->$name === null))
		{
			$this->$name = $value[0];
		}
		return $this;
	}

}
