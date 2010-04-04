<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Action column for the Grid library
 *
 * @package     Grid
 * @author      Kyle Treubig
 * @copyright   (C) 2010 Kyle Treubig
 * @license     MIT
 */
class Grid_Column_Action extends Grid_Column {

	/**
	 * @var string  dataset record field to append to action URL, defaults to "id"
	 */
	public $field = 'id';

	/**
	 * @var string  action URL
	 */
	public $action;

	/**
	 * @var string  CSS class
	 */
	public $class;

	/**
	 * @var string  display text
	 */
	public $text;

	/**
	 * @var string  display image
	 */
	public $img;

	/**
	 * @var string  record field to use as display text
	 */
	public $display_field;

	/**
	 * Render the table cell for this column, given data.
	 *
	 * Returns a link to the action url.
	 *
	 * @param   object  dataset record
	 * @param   array   dataset record
	 * @return  string
	 */
	public function render($data) {
		$data = (object) $data;
		$text = empty($this->img) ? $this->text : $this->img;
		$text = empty($this->display_field)
			? $text
			: $data->{$this->display_field};
		$class = empty($this->class) ? array() : array('class' => $this->class);
		return html::anchor($this->action.'/'.$data->{$this->field}, $text, $class);
	}

}	// End of Grid_Column_Action

