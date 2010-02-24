<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Date column for Grid library
 *
 * @package     Grid
 * @author      Kyle Treubig
 * @copyright   (C) 2010 Kyle Treubig
 * @license     MIT
 */
class Grid_Column_Date extends Grid_Column {

	/**
	 * @var string  dataset record field to use, defaults to "id"
	 */
	public $field = 'date';

	/**
	 * @var string  date output format, used with PHP's date() function
	 */
	public $format = 'Y-m-d H:i:s';

	/**
	 * Render the table cell for this column, given data.
	 *
	 * Returns a timestamp formatted into a readable string.
	 *
	 * @param   object  dataset record
	 * @param   array   dataset record
	 * @return  string
	 */
	public function render($data) {
		$data = (object) $data;
		$text = $data->{$this->field};
		return date($this->format, $text);
	}

}	// End of Grid_Column_Date

