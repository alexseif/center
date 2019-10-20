<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191020123624 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE instrument_tutor');
        $this->addSql('ALTER TABLE tutor_instrument DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE tutor_instrument ADD PRIMARY KEY (instrument_id, tutor_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE instrument_tutor (instrument_id INT NOT NULL, tutor_id INT NOT NULL, INDEX IDX_41DDF221208F64F1 (tutor_id), INDEX IDX_41DDF221CF11D9C (instrument_id), PRIMARY KEY(instrument_id, tutor_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE instrument_tutor ADD CONSTRAINT FK_41DDF221208F64F1 FOREIGN KEY (tutor_id) REFERENCES tutor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE instrument_tutor ADD CONSTRAINT FK_41DDF221CF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tutor_instrument DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE tutor_instrument ADD PRIMARY KEY (tutor_id, instrument_id)');
    }
}
