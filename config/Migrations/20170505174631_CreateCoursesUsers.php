<?php
use Migrations\AbstractMigration;

class CreateCoursesUsers extends AbstractMigration
{

    public $autoId = false;

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('courses_users');
        $table->addColumn('id', 'uuid', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('created_by_id', 'uuid', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified_by_id', 'uuid', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('user_id', 'uuid', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('course_id', 'uuid', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('deleted', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addIndex([
            'created_by_id',
        ], [
            'name' => 'BY_CREATED_BY_ID',
            'unique' => false,
        ]);
        $table->addIndex([
            'modified_by_id',
        ], [
            'name' => 'BY_MODIFIED_BY_ID',
            'unique' => false,
        ]);
        $table->addIndex([
            'user_id',
        ], [
            'name' => 'BY_USER_ID',
            'unique' => false,
        ]);
        $table->addIndex([
            'course_id',
        ], [
            'name' => 'BY_COURSE_ID',
            'unique' => false,
        ]);
        $table->addPrimaryKey([
            'id',
        ]);
        $table->create();
    }
}
