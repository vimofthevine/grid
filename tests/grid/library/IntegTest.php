<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Grid module library integration tests
 *
 * @author  Kyle Treubig
 * @group   grid
 * @group   grid.library
 */
class Grid_Library_IntegTest extends PHPUnit_Framework_TestCase {

    /**
     * Test column creation method
     */
    public function testColumnCreation() {
        $SUT = new Grid;
        $column = $SUT->column('date');
        $this->assertThat($column, $this->isInstanceOf('Grid_Column'));
        $this->assertThat($column, $this->isInstanceOf('Grid_Column_Date'));
    }

    /**
     * Test column ordering
     */
    function testColumnOrdering() {
        $SUT = new Grid;
        $SUT->column()->field('field1')->title('ABCDEF');
        $SUT->column()->field('field2')->title('UVWXYZ');
        $grid = $SUT->render();
        $this->assertRegExp('/ABCDEF.*UVWXYZ/', $grid);
    }

    /**
     * Test link creation method
     */
    function testLinkCreation() {
        $SUT = new Grid;
        $link = $SUT->link();
        $this->assertThat($link, $this->isInstanceOf('Grid_Link'));
    }

    /**
     * Test data definition method
     */
    function testDataDefinition() {
        $dataset1 = array(
            'object1' => array('name'=>'Bob'),
            'object2' => array('name'=>'Ben'),
        );
        $dataset2 = array(
            'object3' => array('name'=>'Bud'),
        );

        $SUT = new Grid;
        $SUT->column()->field('name')->title('Name');

        $SUT->data($dataset1);
        $grid = $SUT->render();
        $this->assertRegExp('/Bob/', $grid);
        $this->assertNotRegExp('/Bud/', $grid);

        $SUT->data($dataset2);
        $grid = $SUT->__tostring();
        $this->assertRegExp('/Ben/', $grid);
        $this->assertRegExp('/Bud/', $grid);
    }
}

