<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191124111238 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_81398E09A0D96FBF ON customer');
        $this->addSql('DROP INDEX UNIQ_81398E0992FC23A8 ON customer');
        $this->addSql('DROP INDEX UNIQ_81398E09C05FB297 ON customer');
        $this->addSql('ALTER TABLE customer ADD mobile VARCHAR(255) NOT NULL, DROP username, DROP username_canonical, DROP email_canonical, DROP enabled, DROP salt, DROP last_login, DROP confirmation_token, DROP password_requested_at, DROP roles, CHANGE email email VARCHAR(255) NOT NULL, CHANGE password name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE customer ADD username VARCHAR(180) NOT NULL COLLATE utf8_unicode_ci, ADD username_canonical VARCHAR(180) NOT NULL COLLATE utf8_unicode_ci, ADD email_canonical VARCHAR(180) NOT NULL COLLATE utf8_unicode_ci, ADD enabled TINYINT(1) NOT NULL, ADD salt VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, ADD password VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD last_login DATETIME DEFAULT NULL, ADD confirmation_token VARCHAR(180) DEFAULT NULL COLLATE utf8_unicode_ci, ADD password_requested_at DATETIME DEFAULT NULL, ADD roles LONGTEXT NOT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:array)\', DROP name, DROP mobile, CHANGE email email VARCHAR(180) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_81398E09A0D96FBF ON customer (email_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_81398E0992FC23A8 ON customer (username_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_81398E09C05FB297 ON customer (confirmation_token)');
    }
}
