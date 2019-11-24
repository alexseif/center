<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191124133431 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE config (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, value LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955591CC992');
        $this->addSql('DROP INDEX IDX_42C84955591CC992 ON reservation');
        $this->addSql('ALTER TABLE reservation CHANGE course_id course_price_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849557FA0AAB1 FOREIGN KEY (course_price_id) REFERENCES course_price (id)');
        $this->addSql('CREATE INDEX IDX_42C849557FA0AAB1 ON reservation (course_price_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE config');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849557FA0AAB1');
        $this->addSql('DROP INDEX IDX_42C849557FA0AAB1 ON reservation');
        $this->addSql('ALTER TABLE reservation CHANGE course_price_id course_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955591CC992 FOREIGN KEY (course_id) REFERENCES course_price (id)');
        $this->addSql('CREATE INDEX IDX_42C84955591CC992 ON reservation (course_id)');
    }
}
