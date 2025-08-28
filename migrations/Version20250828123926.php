<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250828123926 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employee DROP CONSTRAINT fk_5d9f75a1783e3463');
        $this->addSql('DROP INDEX idx_5d9f75a1783e3463');
        $this->addSql('ALTER TABLE employee DROP manager_id');
        $this->addSql('ALTER TABLE projet ADD status VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE projet DROP status');
        $this->addSql('ALTER TABLE employee ADD manager_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT fk_5d9f75a1783e3463 FOREIGN KEY (manager_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_5d9f75a1783e3463 ON employee (manager_id)');
    }
}
