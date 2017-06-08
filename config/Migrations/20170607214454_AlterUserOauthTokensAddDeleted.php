<?php
use Migrations\AbstractMigration;

class AlterUserOauthTokensAddDeleted extends AbstractMigration
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
        $table = $this->table('user_oauth_tokens');

        $table->addColumn('deleted', 'datetime', [
            'default' => null,
            'null' => true,
        ]);

        $table->update();
    }
}
