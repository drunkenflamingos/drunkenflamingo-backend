<?php
use Migrations\AbstractMigration;

class AddWordClassData extends AbstractMigration
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
INSERT INTO `word_classes` (`id`, `title`, `identifier`, `description`, `created`, `modified`, `deleted`)
VALUES
	('c1237a53-0e2f-4d6a-ac76-1d0665a9528d', 'Bindeord (konjunktioner)', 'conjunction', 'at, dengang, medmindre, og', '2017-05-25 19:33:16', '2017-05-25 19:33:16', NULL),
	('632c0aea-f25b-4e42-b3ea-3b57e85b6b00', 'Biord (adverbier)', 'adverb', 'dengang, ikke, pladask, under', '2017-05-25 19:32:51', '2017-05-25 19:32:51', NULL),
	('8807660d-294b-4f34-ab3d-b22f46988c1f', 'Forholdsord (præposition)', 'preposition', 'af, ifølge, mellem, under', '2017-05-25 19:33:41', '2017-05-25 19:33:41', NULL),
	('9bcbde8f-ea97-4682-bc41-7f75ba0e44f6', 'Kendeord', 'determiner', 'den (det), en (et), de, -(e)n, -(e)t, -(e)ne', '2017-05-25 19:31:32', '2017-05-25 19:31:32', NULL),
	('bab347f1-856f-48a1-8952-b0ddf37166d6', 'Lydord (onomatopoietikon)', 'onomatopoeia', 'dingeling, kykliky, miav, tik tak', '2017-05-25 19:35:12', '2017-05-25 19:35:37', NULL),
	('fc263f92-a2b1-40dd-b8a1-fd1d38d8e4fe', 'Navneord (substantiv)', 'noun', 'hest, hus', '2017-05-25 19:28:59', '2017-05-25 19:29:37', NULL),
	('53bb2c18-276b-4db0-a5b3-21f81cbdf071', 'Stedord (pronomen)', 'pronoun', 'begge, de, hvad, jeg', '2017-05-25 19:32:00', '2017-05-25 19:32:00', NULL),
	('c1d69ea3-5ead-4adb-b5f2-266dacd80bc5', 'Talord', 'number_words', 'en, niende, syttende, toogtyve', '2017-05-25 19:32:21', '2017-05-25 19:32:21', NULL),
	('0510acfb-d4a3-4017-b487-a3dc1e72c361', 'Tillægsord (adjektiv)', 'adjective', 'stor, blå', '2017-05-25 19:29:59', '2017-05-25 19:29:59', NULL),
	('f043476d-b68c-40ad-aa3f-f3dc56f802e1', 'Udråbsord', 'exclamation', 'av, bravo, nej, pyha', '2017-05-25 19:34:57', '2017-05-25 19:34:57', NULL),
	('84ae32c9-3fa3-4b1e-90f3-ae85b3a1f489', 'Udsagnsord (verber)', 'verb', 'aflevere, lyve, sammensætte, se\r\n', '2017-05-25 19:32:34', '2017-05-25 19:32:34', NULL);

SQL;

        $this->execute($sql);
    }
}
