<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\TableHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\TableHelper Test Case
 */
class TableHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\View\Helper\TableHelper
     */
    public $Table;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->Table = new TableHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Table);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
