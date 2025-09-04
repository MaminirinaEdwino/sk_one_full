<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250904115556 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_interne ADD responsable_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE demande_interne ADD status VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE demande_interne ADD CONSTRAINT FK_10322D3353C59D72 FOREIGN KEY (responsable_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_10322D3353C59D72 ON demande_interne (responsable_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE demande_interne DROP CONSTRAINT FK_10322D3353C59D72');
        $this->addSql('DROP INDEX IDX_10322D3353C59D72');
        $this->addSql('ALTER TABLE demande_interne DROP responsable_id');
        $this->addSql('ALTER TABLE demande_interne DROP status');
    }
}
