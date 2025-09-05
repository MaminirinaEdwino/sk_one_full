<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250905174438 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE document_projet (id SERIAL NOT NULL, projet_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, chemin VARCHAR(255) NOT NULL, tags VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EE772DCFC18272 ON document_projet (projet_id)');
        $this->addSql('ALTER TABLE document_projet ADD CONSTRAINT FK_EE772DCFC18272 FOREIGN KEY (projet_id) REFERENCES projet (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE document_projet DROP CONSTRAINT FK_EE772DCFC18272');
        $this->addSql('DROP TABLE document_projet');
    }
}
