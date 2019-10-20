<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191020123804 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE instrument_room');
        $this->addSql('ALTER TABLE room_instrument DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE room_instrument ADD PRIMARY KEY (instrument_id, room_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE instrument_room (instrument_id INT NOT NULL, room_id INT NOT NULL, INDEX IDX_A500E23354177093 (room_id), INDEX IDX_A500E233CF11D9C (instrument_id), PRIMARY KEY(instrument_id, room_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE instrument_room ADD CONSTRAINT FK_A500E23354177093 FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE instrument_room ADD CONSTRAINT FK_A500E233CF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE room_instrument DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE room_instrument ADD PRIMARY KEY (room_id, instrument_id)');
    }
}
