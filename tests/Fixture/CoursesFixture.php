<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoursesFixture
 *
 */
class CoursesFixture extends TestFixture
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
        'organization_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'grade' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'name' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'deleted' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'BY_CREATED_BY_ID' => ['type' => 'index', 'columns' => ['created_by_id'], 'length' => []],
            'BY_MODIFIED_BY_ID' => ['type' => 'index', 'columns' => ['modified_by_id'], 'length' => []],
            'BY_ORGANIZATION_ID' => ['type' => 'index', 'columns' => ['organization_id'], 'length' => []],
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
            'id' => '4f726183-d6cb-44c9-a1ce-a3533da29ac3',
            'created_by_id' => 'accacce4-be4f-42d6-b411-d24ec73d1a84',
            'modified_by_id' => '168aa8d9-0c2e-41a4-8cf4-e780d577d499',
            'organization_id' => '5f1c45db-7767-40d1-b83c-bc89a92a9726',
            'grade' => 1,
            'name' => 'Lorem ipsum dolor sit amet',
            'created' => '2017-04-30 10:55:46',
            'modified' => '2017-04-30 10:55:46',
            'deleted' => '2017-04-30 10:55:46'
        ],
    ];
}
