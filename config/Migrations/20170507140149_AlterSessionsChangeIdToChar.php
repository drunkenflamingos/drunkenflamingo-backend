<?php
use Migrations\AbstractMigration;

class AlterSessionsChangeIdToChar extends AbstractMigration
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
        $table = $this->table('sessions');

        $table->changeColumn('id', 'char', [
            'limit' => 40,
            'default' => null,
            'null' => false,
        ]);

        $table->update();
    }
}
