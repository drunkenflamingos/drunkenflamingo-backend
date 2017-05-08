<?php

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UserOauthTokensFixture
 *
 */
class UserOauthTokensFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => [
            'type' => 'uuid',
            'length' => null,
            'null' => false,
            'default' => null,
            'comment' => '',
            'precision' => null,
        ],
        'user_id' => [
            'type' => 'uuid',
            'length' => null,
            'null' => false,
            'default' => null,
            'comment' => '',
            'precision' => null,
        ],
        'type' => [
            'type' => 'string',
            'length' => 255,
            'null' => false,
            'default' => null,
            'collate' => 'utf8_general_ci',
            'comment' => '',
            'precision' => null,
            'fixed' => null,
        ],
        'token' => [
            'type' => 'string',
            'length' => 255,
            'null' => false,
            'default' => null,
            'collate' => 'utf8_general_ci',
            'comment' => '',
            'precision' => null,
            'fixed' => null,
        ],
        'refresh_token' => [
            'type' => 'string',
            'length' => 255,
            'null' => true,
            'default' => null,
            'collate' => 'utf8_general_ci',
            'comment' => '',
            'precision' => null,
            'fixed' => null,
        ],
        'expires' => [
            'type' => 'datetime',
            'length' => null,
            'null' => true,
            'default' => null,
            'comment' => '',
            'precision' => null,
        ],
        'created' => [
            'type' => 'datetime',
            'length' => null,
            'null' => false,
            'default' => null,
            'comment' => '',
            'precision' => null,
        ],
        'modified' => [
            'type' => 'datetime',
            'length' => null,
            'null' => false,
            'default' => null,
            'comment' => '',
            'precision' => null,
        ],
        '_indexes' => [
            'BY_USER_ID' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
            'BY_TYPE' => ['type' => 'index', 'columns' => ['type'], 'length' => []],
            'BY_TOKEN' => ['type' => 'index', 'columns' => ['token'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci',
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => '0b8e29f9-e09d-4f6f-8b6e-a1a55ecde470',
            'user_id' => '9548fc10-f15b-414d-a0a3-6d8a916f995c',
            'type' => 'Lorem ipsum dolor sit amet',
            'token' => 'Lorem ipsum dolor sit amet',
            'refresh_token' => 'Lorem ipsum dolor sit amet',
            'expires' => '2017-04-26 12:15:46',
            'created' => '2017-04-26 12:15:46',
            'modified' => '2017-04-26 12:15:46',
        ],
    ];
}
