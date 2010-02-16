<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 * @brief   Date column for Grid library
 * @author  Kyle Treubig
 */
class Grid_Column_Date extends Grid_Column {

    /** Dataset field to use, defaults to "id" */
    public $field = 'date';
    /** Date output format */
    public $format = 'Y-m-d H:i:s';

    /**
     * Render the table cell for this column, given data.
     * Returns a timestamp formatted into a readable string.
     * @param data  dataset object
     * @return      string
     */
    public function render($data) {
        $data = (object) $data;
        $text = $data->{$this->field};
        return date($this->format, $text);
    }

}

