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
	public $url;

	/**
	 * @var Route   action route
	 */
	public $route;

	/**
	 * @var params  route parameters
	 */
	public $params;

	/**
	 * @var param   route parameter to modify
	 */
	public $param;

	/**
	 * @var string  CSS class
	 */
	public $class;

	/**
	 * @var string  display text
	 */
	public $text;

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
		$data  = (object) $data;
		$value = $data->{$this->field};
		$text  = $this->text;

		// If text is in {field} notation, use dynamic text
		if (preg_match('/\{(\w+)\}/', $this->text, $matches))
		{
			$text = $data->{$matches[1]};
		}

		$class = empty($this->class) ? array() : array('class' => $this->class);

		if (empty($this->route))
		{
			$url = $this->url.'/'.$value;
		}
		else
		{
			$param = empty($this->param) ? $this->field : $this->param;
			$params = $this->params + array($param => $value);
			$url = $this->route->uri($params);
		}

		return HTML::anchor($url, $text, $class);
	}

}	// End of Grid_Column_Action

