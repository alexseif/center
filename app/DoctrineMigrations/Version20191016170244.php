<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191016170244 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE instrument ADD room_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE instrument ADD CONSTRAINT FK_3CBF69DD54177093 FOREIGN KEY (room_id) REFERENCES room (id)');
        $this->addSql('CREATE INDEX IDX_3CBF69DD54177093 ON instrument (room_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE instrument DROP FOREIGN KEY FK_3CBF69DD54177093');
        $this->addSql('DROP INDEX IDX_3CBF69DD54177093 ON instrument');
        $this->addSql('ALTER TABLE instrument DROP room_id');
    }
}
