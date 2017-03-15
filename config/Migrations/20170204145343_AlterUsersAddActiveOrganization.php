<?php
use Migrations\AbstractMigration;

class AlterUsersAddActiveOrganization extends AbstractMigration
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

        $table->addColumn('active_organization_id', 'uuid', [
            'default' => null,
            'null' => true,
            'after' => 'language_id',
        ]);
        $table->addIndex([
            'active_organization_id',
        ], [
            'name' => 'BY_ACTIVE_ORGANIZATION_ID',
            'unique' => false,
        ]);

        $table->update();
    }
}
