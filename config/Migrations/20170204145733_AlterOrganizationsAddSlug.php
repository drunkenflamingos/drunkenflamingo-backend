<?php
use Migrations\AbstractMigration;

class AlterOrganizationsAddSlug extends AbstractMigration
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
        $table = $this->table('organizations');
        $table->addColumn('slug', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
            'after' => 'file_name',
        ]);
        $table->update();
    }
}
