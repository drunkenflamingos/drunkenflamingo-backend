<?php
namespace User\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use User\Controller\LanguagesController;

/**
 * User\Controller\LanguagesController Test Case
 */
class LanguagesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.user.languages',
        'plugin.user.created_by',
        'plugin.user.modified_by',
    ];

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
