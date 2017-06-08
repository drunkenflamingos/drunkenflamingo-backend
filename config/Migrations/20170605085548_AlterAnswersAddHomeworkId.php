<?php
use Migrations\AbstractMigration;

class AlterAnswersAddHomeworkId extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('answers');

        $table->addColumn('homework_id', 'uuid', [
            'default' => null,
            'null' => true,
            'after' => 'assignment_id',
        ]);
        $table->addIndex([
            'homework_id',
        ], [
            'name' => 'BY_HOMEWORK_ID',
            'unique' => false,
        ]);
        $table->update();
    }
}
