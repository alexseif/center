<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191209111903 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE course_price DROP INDEX UNIQ_23632531CF11D9C, ADD INDEX IDX_23632531CF11D9C (instrument_id)');
        $this->addSql('ALTER TABLE course_price DROP INDEX UNIQ_23632531208F64F1, ADD INDEX IDX_23632531208F64F1 (tutor_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE course_price DROP INDEX IDX_23632531CF11D9C, ADD UNIQUE INDEX UNIQ_23632531CF11D9C (instrument_id)');
        $this->addSql('ALTER TABLE course_price DROP INDEX IDX_23632531208F64F1, ADD UNIQUE INDEX UNIQ_23632531208F64F1 (tutor_id)');
    }
}
