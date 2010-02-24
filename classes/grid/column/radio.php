<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Radio column for Grid library
 *
 * @package     Grid
 * @author      Kyle Treubig
 * @copyright   (C) 2010 Kyle Treubig
 * @license     MIT
 */
class Grid_Column_Radio extends Grid_Column {

	/**
	 * @var string  dataset record field to use as radio value, defaults to "id"
	 */
	public $field = 'id';

	/**
	 * @var string  radio field name
	 */
	public $name;

	/**
	 * Render the table cell for this column, given data.
	 *
	 * Returns a radio field for the specified dataset field.
	 *
	 * @param   object  dataset record
	 * @param   array   dataset record
	 * @return  string
	 */
	public function render($data) {
		$data = (object) $data;
		return form::radio($this->name, $data->{$this->field});
	}

}	// End of Grid_Column_Radio

