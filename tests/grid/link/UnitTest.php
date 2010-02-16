<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Grid module link model unit tests
 *
 * @author  Kyle Treubig
 * @group   grid
 * @group   grid.models
 * @group   grid.models.link
 */
class Grid_Link_UnitTest extends PHPUnit_Framework_TestCase {

    /**
     * Test member definition methods
     */
    function testMemberDefinition() {
        $SUT = new Grid_Link;
        $SUT->action('controller/method')->text('someText');
        $this->assertEquals('controller/method', $SUT->action);
        $this->assertEquals('someText', $SUT->text);
    }

    /**
     * Test text link creation
     */
    function testTextLinkCreation() {
        $SUT = new Grid_Link;
        $SUT->action('controller/method')->text('someText');
        $link = $SUT->render();
        $expected = html::anchor('controller/method', 'someText');
        $this->assertEquals($expected, $link);
    }

    /**
     * Test button link creation
     */
    function testButtonLinkCreation() {
        $SUT = new Grid_Link('button');
        $SUT->action('controller/method')->text('someText');
        $link = $SUT->render();
        $expected = html::anchor('controller/method', '<button type="button">someText</button>');
        $this->assertEquals($expected, $link);
    }

    /**
     * Test submit link creation
     */
    function testSubmitLinkCreation() {
        $SUT = new Grid_Link('submit');
        $SUT->text('someText');
        $link = $SUT->__tostring();
        $expected = form::submit('submit', 'someText');
        $this->assertEquals($expected, $link);
    }
}
