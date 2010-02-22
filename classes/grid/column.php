<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 * Grid column model base class
 *
 * @package     Grid
 * @author      Kyle Treubig
 * @copyright   (C) 2010 Kyle Treubig
 * @license     MIT
 */
abstract class Grid_Column {

    /** Dataset field */
    public $field;
    /** Column title */
    public $title;

    /**
     * Magic call method to set variable member when
     * variable method is called
     * @param name  variable name
     * @param value variable value
     */
    public function __call($name, $value) {
        if ((isset($this->$name)) OR ($this->$name === null)) {
            $this->$name = $value[0];
        }
        return $this;
    }

}
