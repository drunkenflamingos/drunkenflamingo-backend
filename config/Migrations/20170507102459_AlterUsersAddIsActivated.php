<?php
use Migrations\AbstractMigration;

class AlterUsersAddIsActivated extends AbstractMigration
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

        $table->addColumn('is_activated', 'boolean', [
            'default' => false,
            'null' => false,
            'after' => 'is_root',
        ]);

        $table->addIndex([
            'is_activated',
        ], [
            'name' => 'BY_IS_ACTIVATED',
            'unique' => false,
        ]);
        $table->update();
    }
}
