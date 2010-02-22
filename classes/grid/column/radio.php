<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 * Radio column for Grid library
 *
 * @package     Grid
 * @author      Kyle Treubig
 * @copyright   (C) 2010 Kyle Treubig
 * @license     MIT
 */
class Grid_Column_Radio extends Grid_Column {

    /** Dataset field to use as radio value, defaults to "id" */
    public $field = 'id';
    /** Radio field name */
    public $name;

    /**
     * Render the table cell for this column, given data.
     * Returns a radio field for the specified dataset field.
     * @param data  dataset object
     * @return      string
     */
    public function render($data) {
        $data = (object) $data;
        return form::radio($this->name, $data->{$this->field});
    }

}

