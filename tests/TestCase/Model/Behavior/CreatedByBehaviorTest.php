<?php
namespace App\Test\TestCase\Model\Behavior;

use App\Model\Behavior\CreatedModifiedByBehavior;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Behavior\CreatedByBehavior Test Case
 */
class CreatedByBehaviorTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Behavior\CreatedModifiedByBehavior
     */
    public $CreatedBy;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->CreatedBy = new CreatedModifiedByBehavior();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CreatedBy);

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
