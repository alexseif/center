<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191020121000 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE instrument DROP FOREIGN KEY FK_3CBF69DD2DEBF0CB');
        $this->addSql('DROP INDEX IDX_3CBF69DD2DEBF0CB ON instrument');
        $this->addSql('ALTER TABLE instrument DROP tutors_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE instrument ADD tutors_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE instrument ADD CONSTRAINT FK_3CBF69DD2DEBF0CB FOREIGN KEY (tutors_id) REFERENCES tutor (id)');
        $this->addSql('CREATE INDEX IDX_3CBF69DD2DEBF0CB ON instrument (tutors_id)');
    }
}
