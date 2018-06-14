<?php declare(strict_types=1);

/*
 * (c) Farhad Safarov <ferhad@azerdict.com>
 *
 * @license https://www.mozilla.org/en-US/MPL/2.0/ Mozilla Public License Version 2.0
 */

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20180614122311 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ad_api_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, apiKey VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_467CAD6A800A1141 (apiKey), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ad_dict_english_azerbaijani (id INT AUTO_INCREMENT NOT NULL, english VARCHAR(255) NOT NULL, azerbaijani VARCHAR(255) NOT NULL, terminology SMALLINT NOT NULL, part_of_speech SMALLINT NOT NULL, transcription VARCHAR(255) DEFAULT NULL, meaning SMALLINT DEFAULT NULL, explanation VARCHAR(100) DEFAULT NULL, source VARCHAR(100) NOT NULL, FULLTEXT INDEX IDX_B71A672C8302007A0A02E9 (english, azerbaijani), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE ad_api_user');
        $this->addSql('DROP TABLE ad_dict_english_azerbaijani');
    }
}
