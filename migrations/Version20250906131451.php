<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250906131451 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE jour_de_travail (id SERIAL NOT NULL, jour DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE presence ADD jourdetravail_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE presence ADD CONSTRAINT FK_6977C7A5843895B5 FOREIGN KEY (jourdetravail_id) REFERENCES jour_de_travail (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_6977C7A5843895B5 ON presence (jourdetravail_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE presence DROP CONSTRAINT FK_6977C7A5843895B5');
        $this->addSql('DROP TABLE jour_de_travail');
        $this->addSql('DROP INDEX IDX_6977C7A5843895B5');
        $this->addSql('ALTER TABLE presence DROP jourdetravail_id');
    }
}
