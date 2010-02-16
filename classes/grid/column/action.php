<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 * @brief   Action column for Grid library
 * @author  Kyle Treubig
 */
class Grid_Column_Action extends Grid_Column {

    /** Dataset field to append to action URL, defaults to "id" */
    public $field = 'id';
    /** Action URL */
    public $action;
    /** Display text */
    public $text;
    /** Display image */
    public $img;

    /**
     * Render the table cell for this column, given data.
     * Returns a link to the action url.
     * @param data  dataset object
     * @return      string
     */
    public function render($data) {
        $data = (object) $data;
        $text = empty($this->img) ? $this->text : $this->img;
        return html::anchor($this->action . '/' . $data->{$this->field}, $text);
    }

}

