<?php
use Migrations\AbstractMigration;

class CreateAnswerWordFeedbacks extends AbstractMigration
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
        $table = $this->table('answer_word_feedbacks');
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
        $table->addColumn('answer_word_id', 'uuid', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('text', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('score', 'integer', [
            'default' => null,
            'limit' => 11,
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
            'answer_word_id',
        ], [
            'name' => 'BY_ANSWER_WORD_ID',
            'unique' => false,
        ]);
        $table->addPrimaryKey([
            'id',
        ]);
        $table->create();
    }
}
