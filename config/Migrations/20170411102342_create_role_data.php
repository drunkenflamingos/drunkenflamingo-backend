<?php

use Phinx\Migration\AbstractMigration;

class CreateRoleData extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $this->execute(<<<SQL
INSERT INTO `roles` (`id`, `created_by_id`, `modified_by_id`, `name`, `identifier`, `created`, `modified`, `deleted`)
VALUES
	('f4fdc559-1ea0-11e7-95fd-001c423e4ec9', '9b38e6bf-7c43-40a7-87cf-9c75c4bc649d', '9b38e6bf-7c43-40a7-87cf-9c75c4bc649d', 'Teacher', 'teacher', '2017-04-11 10:23:58', '2017-04-11 10:23:58', NULL),
	('fd300458-1ea0-11e7-95fd-001c423e4ec9', '9b38e6bf-7c43-40a7-87cf-9c75c4bc649d', '9b38e6bf-7c43-40a7-87cf-9c75c4bc649d', 'Student', 'student', '2017-04-11 10:24:11', '2017-04-11 10:24:11', NULL);

SQL
        );

    }
}
