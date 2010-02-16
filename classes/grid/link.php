<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 * @brief   Grid table action link model
 * @author  Kyle Treubig
 */
class Grid_Link {

    /** Link type */
    public $type;
    /** Action URL */
    public $action;
    /** Display text */
    public $text;

    /**
     * Set the link type
     * @param type  [optional] link type
     */
    public function __construct($type='text') {
        $this->type = $type;
    }

    /**
     * Magic call method to set variable members
     * through method calls
     * @param name  variable name
     * @param value variable value
     */
    public function __call($name, $value) {
        if ((isset($this->$name)) OR ($this->$name === null)) {
            $this->$name = $value[0];
        }
        return $this;
    }

    /**
     * Render the link as an HTML string
     */
    public function render() {
        switch($this->type) {
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

}

