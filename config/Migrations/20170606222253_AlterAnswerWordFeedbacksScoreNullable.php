<?php
use Migrations\AbstractMigration;

class AlterAnswerWordFeedbacksScoreNullable extends AbstractMigration
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
        $table = $this->table('answer_word_feedbacks');

        $table->changeColumn('score', 'integer', [
            'null' => true,
            'default' => null,
        ]);

        $table->update();
    }
}
