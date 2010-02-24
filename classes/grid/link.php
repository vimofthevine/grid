<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Grid table action link model
 *
 * @package     Grid
 * @author      Kyle Treubig
 * @copyright   (C) 2010 Kyle Treubig
 * @license     MIT
 */
class Grid_Link {

	/**
	 * @var string  link type
	 */
	public $type;

	/**
	 * @var string  action URL
	 */
	public $action;

	/**
	 * @var string  display text
	 */
	public $text;

	/**
	 * Set the link type
	 *
	 * @param   string  [optional] link type
	 */
	public function __construct($type='text') {
		$this->type = $type;
	}

	/**
	 * Magic call method to set variable members
	 * through method calls
	 *
	 * @param   string      variable name
	 * @param   string      variable value
	 * @return  Grid_Link
	 */
	public function __call($name, $value) {
		if ((isset($this->$name)) OR ($this->$name === null))
		{
			$this->$name = $value[0];
		}
		return $this;
	}

	/**
	 * Render the link as an HTML string
	 *
	 * @return  string
	 */
	public function render() {
		switch ($this->type)
		{
			case 'submit':
				$link = form::submit('submit', $this->text);
			break;
			case 'button':
				$link = html::anchor($this->action, '<button type="button">' . $this->text . '</button>');
			break;
			case 'link':
			default:
				$link = html::anchor($this->action, $this->text);
		}
		return $link;
	}

	/**
	 * Alias for Grid_Link::render()
	 */
	public function __tostring() {
		return $this->render();
	}

}	// End of Grid_Link

