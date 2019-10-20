<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191020144425 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE slot (id INT AUTO_INCREMENT NOT NULL, room_id INT DEFAULT NULL, instrument_id INT DEFAULT NULL, tutor_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, startAt DATETIME NOT NULL, endAt DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_AC0E206754177093 (room_id), INDEX IDX_AC0E2067CF11D9C (instrument_id), INDEX IDX_AC0E2067208F64F1 (tutor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE slot ADD CONSTRAINT FK_AC0E206754177093 FOREIGN KEY (room_id) REFERENCES room (id)');
        $this->addSql('ALTER TABLE slot ADD CONSTRAINT FK_AC0E2067CF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id)');
        $this->addSql('ALTER TABLE slot ADD CONSTRAINT FK_AC0E2067208F64F1 FOREIGN KEY (tutor_id) REFERENCES tutor (id)');
        $this->addSql('DROP TABLE instrument_room');
        $this->addSql('ALTER TABLE room_instrument DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE room_instrument ADD CONSTRAINT FK_84D19C1CF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE room_instrument ADD CONSTRAINT FK_84D19C154177093 FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE room_instrument ADD PRIMARY KEY (instrument_id, room_id)');
        $this->addSql('ALTER TABLE tutor_instrument DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE tutor_instrument ADD CONSTRAINT FK_F475D4FBCF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tutor_instrument ADD CONSTRAINT FK_F475D4FB208F64F1 FOREIGN KEY (tutor_id) REFERENCES tutor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tutor_instrument ADD PRIMARY KEY (instrument_id, tutor_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE instrument_room (instrument_id INT NOT NULL, room_id INT NOT NULL, INDEX IDX_A500E233CF11D9C (instrument_id), INDEX IDX_A500E23354177093 (room_id), PRIMARY KEY(instrument_id, room_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE instrument_room ADD CONSTRAINT FK_A500E23354177093 FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE instrument_room ADD CONSTRAINT FK_A500E233CF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE slot');
        $this->addSql('ALTER TABLE room_instrument DROP FOREIGN KEY FK_84D19C1CF11D9C');
        $this->addSql('ALTER TABLE room_instrument DROP FOREIGN KEY FK_84D19C154177093');
        $this->addSql('ALTER TABLE room_instrument DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE room_instrument ADD PRIMARY KEY (room_id, instrument_id)');
        $this->addSql('ALTER TABLE tutor_instrument DROP FOREIGN KEY FK_F475D4FBCF11D9C');
        $this->addSql('ALTER TABLE tutor_instrument DROP FOREIGN KEY FK_F475D4FB208F64F1');
        $this->addSql('ALTER TABLE tutor_instrument DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE tutor_instrument ADD PRIMARY KEY (tutor_id, instrument_id)');
    }
}
