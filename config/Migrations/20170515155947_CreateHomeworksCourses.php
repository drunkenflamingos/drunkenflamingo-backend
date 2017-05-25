<?php
use Migrations\AbstractMigration;

class CreateHomeworksCourses extends AbstractMigration
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
        $table = $this->table('homeworks_courses');
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
        $table->addColumn('course_id', 'uuid', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('homework_id', 'uuid', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('published_from', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('published_to', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('deadline', 'datetime', [
            'default' => null,
            'null' => true,
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
            'course_id',
        ], [
            'name' => 'BY_COURSE_ID',
            'unique' => false,
        ]);
        $table->addIndex([
            'homework_id',
        ], [
            'name' => 'BY_HOMEWORK_ID',
            'unique' => false,
        ]);
        $table->addIndex([
            'published_from',
        ], [
            'name' => 'BY_PUBLISHED_FROM',
            'unique' => false,
        ]);
        $table->addIndex([
            'published_to',
        ], [
            'name' => 'BY_PUBLISHED_TO',
            'unique' => false,
        ]);
        $table->addPrimaryKey([
            'id',
        ]);
        $table->create();
    }
}
