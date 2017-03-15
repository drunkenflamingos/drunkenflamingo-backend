<?php
use Migrations\AbstractMigration;

class AlterUsersChangeToken extends AbstractMigration
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
        $table->renameColumn('reset_token', 'token');
        $table->addIndex([
            'token',
        ], [
            'name' => 'UNIQUE_TOKEN',
            'unique' => true,
        ]);
        $table->update();
    }
}
