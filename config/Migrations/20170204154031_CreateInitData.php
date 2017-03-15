<?php
use Migrations\AbstractMigration;

class CreateInitData extends AbstractMigration
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
        $this->execute(<<<SQL
INSERT INTO `countries` (`id`, `currency_id`, `language_id`, `name`, `iso_code`, `created`, `modified`, `deleted`)
VALUES
	('1bc4565b-52ce-4cbb-8a3c-3ad4b1745c61', '717f688f-e1c0-4d70-b21f-018255ad8c6b', 'bb9c8b2c-d90c-48ad-8065-9112ecfe8882', 'Denmark', 'DK', '2017-02-04 15:40:13', '2017-02-04 15:40:13', NULL),
	('60a4c5eb-c4e7-460d-a29e-82042cd21687', '6602941e-937b-4527-8649-41e1ab1d2013', 'e042f812-5f02-472b-997d-a20ab59ab8d1', 'Germany', 'DE', '2017-02-04 15:40:16', '2017-02-04 15:40:14', NULL),
	('c5a6b238-9af9-400e-94d4-25f4ac612655', 'b1b287c7-538b-4109-a8c8-85c5e7ae4b4a', '20115dff-e646-49e1-88a2-dc055c373b8f', 'United States', 'US', '2017-02-04 15:40:16', '2017-02-04 15:40:16', NULL);
SQL
        );

        $this->execute(<<<SQL
INSERT INTO `currencies` (`id`, `created_by_id`, `modified_by_id`, `name`, `iso_code`, `short_name`, `created`, `modified`, `deleted`)
VALUES
	('6602941e-937b-4527-8649-41e1ab1d2013', '9b38e6bf-7c43-40a7-87cf-9c75c4bc649d', '9b38e6bf-7c43-40a7-87cf-9c75c4bc649d', 'Euro', '€', 'EUR', '2017-02-04 14:17:39', '2017-02-04 14:17:39', NULL),
	('717f688f-e1c0-4d70-b21f-018255ad8c6b', '9b38e6bf-7c43-40a7-87cf-9c75c4bc649d', '9b38e6bf-7c43-40a7-87cf-9c75c4bc649d', 'Danish Kroner', 'DKK', 'kr.', '2017-02-04 14:17:54', '2017-02-04 14:17:54', NULL),
	('b1b287c7-538b-4109-a8c8-85c5e7ae4b4a', '9b38e6bf-7c43-40a7-87cf-9c75c4bc649d', '9b38e6bf-7c43-40a7-87cf-9c75c4bc649d', 'US Dollars', 'USD', '$', '2017-02-04 14:18:00', '2017-02-04 14:18:00', NULL);
SQL
        );

        $this->execute(<<<SQL
INSERT INTO `languages` (`id`, `created_by_id`, `modified_by_id`, `name`, `iso_code`, `created`, `modified`, `deleted`)
VALUES
	('20115dff-e646-49e1-88a2-dc055c373b8f', '9b38e6bf-7c43-40a7-87cf-9c75c4bc649d', '9b38e6bf-7c43-40a7-87cf-9c75c4bc649d', 'English', 'en-US', '2017-02-04 14:11:31', '2017-02-04 14:11:31', NULL),
	('bb9c8b2c-d90c-48ad-8065-9112ecfe8882', '9b38e6bf-7c43-40a7-87cf-9c75c4bc649d', '9b38e6bf-7c43-40a7-87cf-9c75c4bc649d', 'Danish', 'da-DK', '2017-02-04 14:11:34', '2017-02-04 14:11:34', NULL),
	('e042f812-5f02-472b-997d-a20ab59ab8d1', '9b38e6bf-7c43-40a7-87cf-9c75c4bc649d', '9b38e6bf-7c43-40a7-87cf-9c75c4bc649d', 'German', 'de-DE', '2017-02-04 14:11:39', '2017-02-04 14:11:39', NULL);
SQL
        );

        $this->execute(<<<SQL
INSERT INTO `roles` (`id`, `created_by_id`, `modified_by_id`, `name`, `identifier`, `created`, `modified`, `deleted`)
VALUES
	('1f73fa6a-4169-4955-b08d-f87246a0ab9c', '9b38e6bf-7c43-40a7-87cf-9c75c4bc649d', '9b38e6bf-7c43-40a7-87cf-9c75c4bc649d', 'Company owner', 'owner', '2017-02-04 15:44:55', '2017-02-04 15:44:55', NULL),
	('da041508-5308-44d7-addf-dd800f3d8e17', '9b38e6bf-7c43-40a7-87cf-9c75c4bc649d', '9b38e6bf-7c43-40a7-87cf-9c75c4bc649d', 'Admin', 'admin', '2017-02-04 15:44:57', '2017-02-04 15:44:57', NULL);
SQL
        );
    }
}
