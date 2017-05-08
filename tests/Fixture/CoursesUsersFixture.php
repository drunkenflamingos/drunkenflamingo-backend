<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoursesUsersFixture
 *
 */
class CoursesUsersFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'created_by_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified_by_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'user_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'course_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'deleted' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'BY_CREATED_BY_ID' => ['type' => 'index', 'columns' => ['created_by_id'], 'length' => []],
            'BY_MODIFIED_BY_ID' => ['type' => 'index', 'columns' => ['modified_by_id'], 'length' => []],
            'BY_USER_ID' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
            'BY_COURSE_ID' => ['type' => 'index', 'columns' => ['course_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
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
            'id' => 'f609c722-3cd8-4d80-815d-049e97bd219f',
            'created_by_id' => 'e7659dea-10dd-4adf-a012-f7bf70fdeb82',
            'modified_by_id' => '3a4ab9e1-8a66-4006-b500-419001db597c',
            'user_id' => '3bdfaf00-ddb7-438f-9b50-732023c8a2c3',
            'course_id' => 'ed01f053-1595-470a-a65d-932cf695a3f1',
            'created' => '2017-05-05 17:46:50',
            'modified' => '2017-05-05 17:46:50',
            'deleted' => '2017-05-05 17:46:50'
        ],
    ];
}
