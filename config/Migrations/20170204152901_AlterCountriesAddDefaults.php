<?php
use Migrations\AbstractMigration;

class AlterCountriesAddDefaults extends AbstractMigration
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
        $table = $this->table('countries');
        $table->addColumn('currency_id', 'uuid', [
            'default' => null,
            'null' => false,
            'after' => 'id',
        ]);
        $table->addColumn('language_id', 'uuid', [
            'default' => null,
            'null' => false,
            'after' => 'currency_id',
        ]);
        $table->addIndex([
            'currency_id',
        ], [
            'name' => 'BY_CURRENCY_ID',
            'unique' => false,
        ]);
        $table->addIndex([
            'language_id',
        ], [
            'name' => 'BY_LANGUAGE_ID',
            'unique' => false,
        ]);
        $table->update();
    }
}
