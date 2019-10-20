<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191020122755 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tutor_instrument (tutor_id INT NOT NULL, instrument_id INT NOT NULL, INDEX IDX_F475D4FB208F64F1 (tutor_id), INDEX IDX_F475D4FBCF11D9C (instrument_id), PRIMARY KEY(tutor_id, instrument_id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room_instrument (room_id INT NOT NULL, instrument_id INT NOT NULL, INDEX IDX_84D19C154177093 (room_id), INDEX IDX_84D19C1CF11D9C (instrument_id), PRIMARY KEY(room_id, instrument_id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instrument_room (instrument_id INT NOT NULL, room_id INT NOT NULL, INDEX IDX_A500E233CF11D9C (instrument_id), INDEX IDX_A500E23354177093 (room_id), PRIMARY KEY(instrument_id, room_id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instrument_tutor (instrument_id INT NOT NULL, tutor_id INT NOT NULL, INDEX IDX_41DDF221CF11D9C (instrument_id), INDEX IDX_41DDF221208F64F1 (tutor_id), PRIMARY KEY(instrument_id, tutor_id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tutor_instrument ADD CONSTRAINT FK_F475D4FB208F64F1 FOREIGN KEY (tutor_id) REFERENCES tutor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tutor_instrument ADD CONSTRAINT FK_F475D4FBCF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE room_instrument ADD CONSTRAINT FK_84D19C154177093 FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE room_instrument ADD CONSTRAINT FK_84D19C1CF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE instrument_room ADD CONSTRAINT FK_A500E233CF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE instrument_room ADD CONSTRAINT FK_A500E23354177093 FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE instrument_tutor ADD CONSTRAINT FK_41DDF221CF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE instrument_tutor ADD CONSTRAINT FK_41DDF221208F64F1 FOREIGN KEY (tutor_id) REFERENCES tutor (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE tutor_instrument');
        $this->addSql('DROP TABLE room_instrument');
        $this->addSql('DROP TABLE instrument_room');
        $this->addSql('DROP TABLE instrument_tutor');
    }
}
