<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 * @brief   Grid modeling library for creating data tables
 * @author  Kyle Treubig
 */
class Grid_Core {

    /** Array of table columns */
    private $columns = array();
    /** Array of action links */
    private $links = array();
    /** Table dataset */
    private $dataset = array();

    /**
     * Add a column to the table
     * @param type  [optional] column type
     */
    public function &column($type='text') {
        $model = 'Grid_Column_' . ucfirst($type);
        $column = new $model;
        $index = count($this->columns);
        array_push($this->columns, $column);
        Kohana::$log->add(Kohana::DEBUG, 'Added '.$type.' column to grid');
        return $this->columns[$index];
    }

    /**
     * Add an action link to the table
     * @param type  [optional] link type
     */
    public function &link($type='text') {
        $link = new Grid_Link($type);
        $index = count($this->links);
        array_push($this->links, $link);
        Kohana::$log->add(Kohana::DEBUG, 'Added '.$type.' link to grid');
        return $this->links[$index];
    }

    /**
     * Add data to the table
     * @param resource  array of data objects
     */
    public function data($resource) {
        $dataset = array();
        foreach($resource as $data) {
            $dataset[] = $data;
        }
        array_splice($this->dataset, count($this->dataset), 0, $dataset);
        Kohana::$log->add(Kohana::DEBUG, 'Added data to grid');
        return $this;
    }

    /**
     * Render the table as an HTML string
     */
    public function render($view = 'grid/table') {
        $view = View::factory($view);
        $view->columns = $this->columns;
        $view->links   = $this->links;
        $view->dataset = $this->dataset;
        Kohana::$log->add(Kohana::DEBUG, 'Rendering the grid');
        return $view->render();
    }

    /**
     * Alias for Grid::render()
     */
    public function __tostring() {
        return $this->render();
    }

}

