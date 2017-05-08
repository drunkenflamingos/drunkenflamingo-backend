<?php
use Migrations\AbstractMigration;

class AddMoreRoles extends AbstractMigration
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
        $sql = <<<SQL
INSERT INTO `roles` (`id`, `created_by_id`, `modified_by_id`, `name`, `identifier`, `created`, `modified`, `deleted`)
VALUES
	('edcd19d7-2a66-11e7-9539-001c423e4ec9', '9b38e6bf-7c43-40a7-87cf-9c75c4bc649d', '9b38e6bf-7c43-40a7-87cf-9c75c4bc649d', 'Teacher Admin', 'teacher_admin', '2017-04-26 09:58:53', '2017-04-26 09:58:53', NULL);
SQL;
        $this->execute($sql);
    }
}
