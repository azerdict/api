<?php declare(strict_types=1);

/*
 * (c) Farhad Safarov <ferhad@azerdict.com>
 *
 * @license https://www.mozilla.org/en-US/MPL/2.0/ Mozilla Public License Version 2.0
 */

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20180614112820 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ad_dict_english_azerbaijani (id INT AUTO_INCREMENT NOT NULL, english VARCHAR(255) NOT NULL, azerbaijani VARCHAR(255) NOT NULL, terminology SMALLINT NOT NULL, part_of_speech SMALLINT NOT NULL, transcription VARCHAR(255) DEFAULT NULL, meaning SMALLINT DEFAULT NULL, explanation VARCHAR(100) DEFAULT NULL, source VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ad_dict_english_azerbaijani RENAME INDEX fulltext_ea TO IDX_B71A672C8302007A0A02E9');
        $this->addSql('CREATE TABLE ad_api_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, apiKey VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_467CAD6A800A1141 (apiKey), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ad_dict_english_azerbaijani RENAME INDEX idx_b71a672c8302007a0a02e9 TO fulltext_ea');
        $this->addSql('DROP TABLE ad_dict_english_azerbaijani');
        $this->addSql('DROP TABLE ad_api_user');
    }
}
