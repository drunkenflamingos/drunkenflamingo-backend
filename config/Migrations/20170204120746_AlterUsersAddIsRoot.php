<?php
use Migrations\AbstractMigration;

class AlterUsersAddIsRoot extends AbstractMigration
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
        $table->addColumn('is_root', 'boolean', [
            'default' => null,
            'null' => false,
            'after' => 'is_activated',
        ]);
        $table->update();
    }
}
