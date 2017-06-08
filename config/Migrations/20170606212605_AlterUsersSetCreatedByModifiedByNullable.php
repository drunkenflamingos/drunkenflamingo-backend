<?php
use Migrations\AbstractMigration;

class AlterUsersSetCreatedByModifiedByNullable extends AbstractMigration
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
        $table = $this->table('users');

        $table->changeColumn('created_by_id', 'uuid', [
            'null' => true,
        ]);
        $table->changeColumn('modified_by_id', 'uuid', [
            'null' => true,
        ]);

        $table->update();
    }
}
