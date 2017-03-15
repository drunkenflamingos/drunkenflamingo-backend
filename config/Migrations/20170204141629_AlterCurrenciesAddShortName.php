<?php
use Migrations\AbstractMigration;

class AlterCurrenciesAddShortName extends AbstractMigration
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
        $table = $this->table('currencies');

        $table->addColumn('short_name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
            'after' => 'iso_code',
        ]);
        $table->update();
    }
}
