<?php
namespace User\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use User\Controller\OrganizationsController;

/**
 * User\Controller\OrganizationsController Test Case
 */
class OrganizationsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.user.organizations',
        'plugin.user.created_by',
        'plugin.user.modified_by',
        'plugin.user.contact_people',
        'plugin.user.default_languages',
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
