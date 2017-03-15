<?php
use Migrations\AbstractMigration;

class CreateOrganizations extends AbstractMigration
{

    public $autoId = false;

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
        $table->addColumn('id', 'uuid', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('created_by_id', 'uuid', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified_by_id', 'uuid', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('contact_person_id', 'uuid', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('language_id', 'uuid', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('country_id', 'uuid', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('invoice_email', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('phone_number', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('vat_number', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('street_name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('zip_code', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('city', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('file_dir', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('file_size', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('file_type', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('file_name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('is_activated', 'boolean', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('deleted', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addIndex([
            'created_by_id',
        ], [
            'name' => 'BY_CREATED_BY_ID',
            'unique' => false,
        ]);
        $table->addIndex([
            'modified_by_id',
        ], [
            'name' => 'BY_MODIFIED_BY_ID',
            'unique' => false,
        ]);
        $table->addIndex([
            'language_id',
        ], [
            'name' => 'BY_LANGUAGE_ID',
            'unique' => false,
        ]);
        $table->addIndex([
            'country_id',
        ], [
            'name' => 'BY_COUNTRY_ID',
            'unique' => false,
        ]);
        $table->addPrimaryKey([
            'id',
        ]);
        $table->create();
    }
}
