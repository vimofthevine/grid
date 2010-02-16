<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Grid module column model unit tests
 *
 * @author  Kyle Treubig
 * @group   grid
 * @group   grid.models
 * @group   grid.models.column
 */
class Grid_Column_UnitTest extends PHPUnit_Framework_TestCase {

    /**
     * Test member definition methods
     */
    public function testMemberDefinition() {
        $SUT = new Grid_Column_Text;
        $SUT->field('someField')->title('someTitle');
        $this->assertEquals('someField', $SUT->field);
        $this->assertEquals('someTitle', $SUT->title);
    }

    /**
     * Test text column callback
     */
    public function testTextColumnCallback() {
        $SUT = new Grid_Column_Text;
        $SUT->field('name')->callback(array($this, 'stubCallback'));

        $data = array('name'=>'bob');
        $cell = $SUT->render($data);

        $this->assertEquals('Bob', $cell);
        $this->assertNotEquals('bob', $cell);
    }

    /**
     * Stub callback function
     */
    public function stubCallback($str) {
        return ucfirst($str);
    }

    /**
     * Test text column sub-member
     */
    public function testTextColumnSubMember() {
        $SUT = new Grid_Column_Text;
        $SUT->field('author')->member('name');

        $author = array('name' => 'someName');
        $data = array('author' => (object) $author);
        $cell = $SUT->render($data);
        $this->assertEquals('someName', $cell);
    }

    /**
     * Test action column
     */
    public function testActionColumn() {
        $SUT = new Grid_Column_Action;
        $SUT->action('controller/method')->text('click me');

        $data = array('id'=>42);
        $cell = $SUT->render($data);
        $url = html::anchor('controller/method/42', 'click me');

        $this->assertEquals($url, $cell);
    }

    /**
     * Test date column
     */
    public function testDateColumn() {
        $SUT = new Grid_Column_Date;
        $SUT->field('date');

        $data = array('date' => strtotime('June 24, 2009, 11:17 am'));
        $cell = $SUT->render($data);
        $this->assertEquals('2009-06-24 11:17:00', $cell);
    }

    /**
     * Test radio column
     */
    public function testRadioColumn() {
        $SUT = new Grid_Column_Radio;
        $SUT->name('someOption');

        $data = array('id'=>42);
        $cell = $SUT->render($data);
        $radio = form::radio('someOption', 42);

        $this->assertEquals($radio, $cell);
    }

}
