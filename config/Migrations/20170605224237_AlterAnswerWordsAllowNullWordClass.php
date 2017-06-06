<?php
use Migrations\AbstractMigration;

class AlterAnswerWordsAllowNullWordClass extends AbstractMigration
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
        $table->changeColumn('word_class_id', 'uuid', [
            'null' => true,
        ]);
        $table->update();
    }
}
