<?php
use Migrations\AbstractMigration;

class AlterUsersRemovePhone extends AbstractMigration
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

        $table->removeColumn('phone_number');

        $table->update();
    }
}
