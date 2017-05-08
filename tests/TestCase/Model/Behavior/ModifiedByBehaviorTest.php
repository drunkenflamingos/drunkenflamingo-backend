<?php
namespace App\Test\TestCase\Model\Behavior;

use App\Model\Behavior\ModifiedByBehavior;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Behavior\ModifiedByBehavior Test Case
 */
class ModifiedByBehaviorTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Behavior\ModifiedByBehavior
     */
    public $ModifiedBy;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->ModifiedBy = new ModifiedByBehavior();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ModifiedBy);

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
