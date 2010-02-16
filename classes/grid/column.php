<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 * @brief   Grid column model base class
 * @author  Kyle Treubig
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
