<?php
use Migrations\AbstractMigration;

class AlterAnswerWordsAddAnswerId extends AbstractMigration
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
        $table = $this->table('answer_words');

        $table->addColumn('answer_id', 'uuid', [
            'default' => null,
            'null' => false,
            'after' => 'modified_by_id',
        ]);
        $table->addIndex([
            'answer_id',
        ], [
            'name' => 'BY_ANSWER_ID',
            'unique' => false,
        ]);
        $table->update();
    }
}
