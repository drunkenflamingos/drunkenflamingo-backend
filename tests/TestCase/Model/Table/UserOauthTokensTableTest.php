<?php

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserOauthTokensTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserOauthTokensTable Test Case
 */
class UserOauthTokensTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UserOauthTokensTable
     */
    public $UserOauthTokens;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.user_oauth_tokens',
        'app.users',
        'app.languages',
        'app.created_by',
        'app.users_roles',
        'app.modified_by',
        'app.roles',
        'app.organizations',
        'app.countries',
        'app.currencies',
        'app.courses',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UserOauthTokens') ? [] : ['className' => 'App\Model\Table\UserOauthTokensTable'];
        $this->UserOauthTokens = TableRegistry::get('UserOauthTokens', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserOauthTokens);

        parent::tearDown();
    }

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
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
