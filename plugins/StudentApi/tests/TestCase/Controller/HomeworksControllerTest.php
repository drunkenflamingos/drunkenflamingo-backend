<?php
namespace StudentApi\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use StudentApi\Controller\HomeworksController;

/**
 * StudentApi\Controller\HomeworksController Test Case
 */
class HomeworksControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.student_api.homeworks',
        'plugin.student_api.created_by',
        'plugin.student_api.languages',
        'plugin.student_api.modified_by',
        'plugin.student_api.users_roles',
        'plugin.student_api.users',
        'plugin.student_api.user_oauth_tokens',
        'plugin.student_api.courses',
        'plugin.student_api.courses_users',
        'plugin.student_api.organizations',
        'plugin.student_api.countries',
        'plugin.student_api.currencies',
        'plugin.student_api.contact_people',
        'plugin.student_api.roles',
        'plugin.student_api.homeworks_courses'
    ];

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test beforeFilter method
     *
     * @return void
     */
    public function testBeforeFilter()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
