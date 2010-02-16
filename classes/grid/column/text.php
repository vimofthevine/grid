<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 * @brief   Text column for Grid library
 * @author  Kyle Treubig
 */
class Grid_Column_Text extends Grid_Column {

    /** Sub-member of dataset value to print */
    public $member   = null;
    /** Callback function */
    public $callback = null;


    /**
     * Render the table cell for this column, given data.
     * Outputs the dataset field, or sub-member of that field,
     * parsed by the parsing function and/or callback function.
     * @param data  dataset object
     * @return      string
     */
    public function render($data) {
        $data = (object) $data;
        $text = $data->{$this->field};
        if ( ! empty($this->member)) {
            $text = $text->{$this->member};
        }
        if ( ! empty($this->callback)) {
            $text = call_user_func($this->callback, $text);
        }

        return $text;
    }

}

