<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250826161451 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bu (id SERIAL NOT NULL, manager_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_367D9E69783E3463 ON bu (manager_id)');
        $this->addSql('CREATE TABLE categorie_fonctionnelle (id SERIAL NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE commentaire_demande (id SERIAL NOT NULL, auteur_id INT DEFAULT NULL, demande_id INT DEFAULT NULL, commentaire VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_555C45F660BB6FE6 ON commentaire_demande (auteur_id)');
        $this->addSql('CREATE INDEX IDX_555C45F680E95E18 ON commentaire_demande (demande_id)');
        $this->addSql('CREATE TABLE conge (id SERIAL NOT NULL, employee_id INT DEFAULT NULL, nbr_jour_conge INT NOT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, valide BOOLEAN NOT NULL, status VARCHAR(255) NOT NULL, validation_rh BOOLEAN NOT NULL, validation_manager BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2ED893488C03F15C ON conge (employee_id)');
        $this->addSql('CREATE TABLE demande_interne (id SERIAL NOT NULL, categorie_id INT DEFAULT NULL, auteur_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, niveau VARCHAR(255) NOT NULL, date_envoi TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_modif TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_10322D33BCF5E72D ON demande_interne (categorie_id)');
        $this->addSql('CREATE INDEX IDX_10322D3360BB6FE6 ON demande_interne (auteur_id)');
        $this->addSql('CREATE TABLE document (id SERIAL NOT NULL, nom VARCHAR(255) NOT NULL, chemin VARCHAR(255) NOT NULL, tags TEXT DEFAULT NULL, type VARCHAR(255) NOT NULL, categorie VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN document.tags IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE employee (id SERIAL NOT NULL, manager_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, emailpro VARCHAR(255) NOT NULL, telephone INT NOT NULL, addresse VARCHAR(255) NOT NULL, date_entree TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_sortie TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5D9F75A1783E3463 ON employee (manager_id)');
        $this->addSql('CREATE TABLE employee_poste (employee_id INT NOT NULL, poste_id INT NOT NULL, PRIMARY KEY(employee_id, poste_id))');
        $this->addSql('CREATE INDEX IDX_948402D28C03F15C ON employee_poste (employee_id)');
        $this->addSql('CREATE INDEX IDX_948402D2A0905086 ON employee_poste (poste_id)');
        $this->addSql('CREATE TABLE employee_bu (employee_id INT NOT NULL, bu_id INT NOT NULL, PRIMARY KEY(employee_id, bu_id))');
        $this->addSql('CREATE INDEX IDX_54708658C03F15C ON employee_bu (employee_id)');
        $this->addSql('CREATE INDEX IDX_5470865E0319FBC ON employee_bu (bu_id)');
        $this->addSql('CREATE TABLE equipe (id SERIAL NOT NULL, nom VARCHAR(255) NOT NULL, disponible VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE groupe_discussion (id SERIAL NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE membre_equipe (id SERIAL NOT NULL, membre_id INT DEFAULT NULL, equipe_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BE402FAC6A99F74A ON membre_equipe (membre_id)');
        $this->addSql('CREATE INDEX IDX_BE402FAC6D861B89 ON membre_equipe (equipe_id)');
        $this->addSql('CREATE TABLE membre_groupe (id SERIAL NOT NULL, membre_id INT DEFAULT NULL, groupe_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9EB019986A99F74A ON membre_groupe (membre_id)');
        $this->addSql('CREATE INDEX IDX_9EB019987A45358C ON membre_groupe (groupe_id)');
        $this->addSql('CREATE TABLE message (id SERIAL NOT NULL, envoyeur_id INT DEFAULT NULL, receveur_id INT DEFAULT NULL, contenu VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B6BD307F4795A786 ON message (envoyeur_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307FB967E626 ON message (receveur_id)');
        $this->addSql('CREATE TABLE message_groupe (id SERIAL NOT NULL, auteur_id INT DEFAULT NULL, groupe_id INT DEFAULT NULL, message VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_339E112E60BB6FE6 ON message_groupe (auteur_id)');
        $this->addSql('CREATE INDEX IDX_339E112E7A45358C ON message_groupe (groupe_id)');
        $this->addSql('CREATE TABLE notification (id SERIAL NOT NULL, auteur_id INT DEFAULT NULL, cible_id INT DEFAULT NULL, contenue VARCHAR(255) NOT NULL, date_envoie TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BF5476CA60BB6FE6 ON notification (auteur_id)');
        $this->addSql('CREATE INDEX IDX_BF5476CAA96E5E09 ON notification (cible_id)');
        $this->addSql('CREATE TABLE parcours_employe (id SERIAL NOT NULL, employee_id INT DEFAULT NULL, parcours VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_776FEDEF8C03F15C ON parcours_employe (employee_id)');
        $this->addSql('CREATE TABLE poste (id SERIAL NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE presence (id SERIAL NOT NULL, employee_id INT DEFAULT NULL, date DATE NOT NULL, status VARCHAR(255) NOT NULL, heure_arrive TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, heure_depart TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6977C7A58C03F15C ON presence (employee_id)');
        $this->addSql('CREATE TABLE projet (id SERIAL NOT NULL, responsable_id INT DEFAULT NULL, equipe_id INT DEFAULT NULL, assignant_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, status_achevement VARCHAR(255) NOT NULL, archive BOOLEAN NOT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_50159CA953C59D72 ON projet (responsable_id)');
        $this->addSql('CREATE INDEX IDX_50159CA96D861B89 ON projet (equipe_id)');
        $this->addSql('CREATE INDEX IDX_50159CA9DB0C7BBE ON projet (assignant_id)');
        $this->addSql('CREATE TABLE tache_normale (id SERIAL NOT NULL, assigne_id INT DEFAULT NULL, assignant_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_creation TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_achevement TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, achevement VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_82CAE7E68E7B8AB0 ON tache_normale (assigne_id)');
        $this->addSql('CREATE INDEX IDX_82CAE7E6DB0C7BBE ON tache_normale (assignant_id)');
        $this->addSql('CREATE TABLE tache_projet (id SERIAL NOT NULL, assigne_id INT DEFAULT NULL, assignant_id INT DEFAULT NULL, projet_id INT DEFAULT NULL, snom VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_creation TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_achevement TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, achevement VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BCE9A3588E7B8AB0 ON tache_projet (assigne_id)');
        $this->addSql('CREATE INDEX IDX_BCE9A358DB0C7BBE ON tache_projet (assignant_id)');
        $this->addSql('CREATE INDEX IDX_BCE9A358C18272 ON tache_projet (projet_id)');
        $this->addSql('CREATE TABLE "user" (id SERIAL NOT NULL, employee_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6498C03F15C ON "user" (employee_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON "user" (email)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE bu ADD CONSTRAINT FK_367D9E69783E3463 FOREIGN KEY (manager_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commentaire_demande ADD CONSTRAINT FK_555C45F660BB6FE6 FOREIGN KEY (auteur_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commentaire_demande ADD CONSTRAINT FK_555C45F680E95E18 FOREIGN KEY (demande_id) REFERENCES demande_interne (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE conge ADD CONSTRAINT FK_2ED893488C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE demande_interne ADD CONSTRAINT FK_10322D33BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie_fonctionnelle (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE demande_interne ADD CONSTRAINT FK_10322D3360BB6FE6 FOREIGN KEY (auteur_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT FK_5D9F75A1783E3463 FOREIGN KEY (manager_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE employee_poste ADD CONSTRAINT FK_948402D28C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE employee_poste ADD CONSTRAINT FK_948402D2A0905086 FOREIGN KEY (poste_id) REFERENCES poste (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE employee_bu ADD CONSTRAINT FK_54708658C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE employee_bu ADD CONSTRAINT FK_5470865E0319FBC FOREIGN KEY (bu_id) REFERENCES bu (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE membre_equipe ADD CONSTRAINT FK_BE402FAC6A99F74A FOREIGN KEY (membre_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE membre_equipe ADD CONSTRAINT FK_BE402FAC6D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE membre_groupe ADD CONSTRAINT FK_9EB019986A99F74A FOREIGN KEY (membre_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE membre_groupe ADD CONSTRAINT FK_9EB019987A45358C FOREIGN KEY (groupe_id) REFERENCES groupe_discussion (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F4795A786 FOREIGN KEY (envoyeur_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FB967E626 FOREIGN KEY (receveur_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE message_groupe ADD CONSTRAINT FK_339E112E60BB6FE6 FOREIGN KEY (auteur_id) REFERENCES membre_groupe (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE message_groupe ADD CONSTRAINT FK_339E112E7A45358C FOREIGN KEY (groupe_id) REFERENCES groupe_discussion (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CA60BB6FE6 FOREIGN KEY (auteur_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CAA96E5E09 FOREIGN KEY (cible_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE parcours_employe ADD CONSTRAINT FK_776FEDEF8C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE presence ADD CONSTRAINT FK_6977C7A58C03F15C FOREIGN KEY (employee_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA953C59D72 FOREIGN KEY (responsable_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA96D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA9DB0C7BBE FOREIGN KEY (assignant_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tache_normale ADD CONSTRAINT FK_82CAE7E68E7B8AB0 FOREIGN KEY (assigne_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tache_normale ADD CONSTRAINT FK_82CAE7E6DB0C7BBE FOREIGN KEY (assignant_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tache_projet ADD CONSTRAINT FK_BCE9A3588E7B8AB0 FOREIGN KEY (assigne_id) REFERENCES membre_equipe (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tache_projet ADD CONSTRAINT FK_BCE9A358DB0C7BBE FOREIGN KEY (assignant_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tache_projet ADD CONSTRAINT FK_BCE9A358C18272 FOREIGN KEY (projet_id) REFERENCES projet (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D6498C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE bu DROP CONSTRAINT FK_367D9E69783E3463');
        $this->addSql('ALTER TABLE commentaire_demande DROP CONSTRAINT FK_555C45F660BB6FE6');
        $this->addSql('ALTER TABLE commentaire_demande DROP CONSTRAINT FK_555C45F680E95E18');
        $this->addSql('ALTER TABLE conge DROP CONSTRAINT FK_2ED893488C03F15C');
        $this->addSql('ALTER TABLE demande_interne DROP CONSTRAINT FK_10322D33BCF5E72D');
        $this->addSql('ALTER TABLE demande_interne DROP CONSTRAINT FK_10322D3360BB6FE6');
        $this->addSql('ALTER TABLE employee DROP CONSTRAINT FK_5D9F75A1783E3463');
        $this->addSql('ALTER TABLE employee_poste DROP CONSTRAINT FK_948402D28C03F15C');
        $this->addSql('ALTER TABLE employee_poste DROP CONSTRAINT FK_948402D2A0905086');
        $this->addSql('ALTER TABLE employee_bu DROP CONSTRAINT FK_54708658C03F15C');
        $this->addSql('ALTER TABLE employee_bu DROP CONSTRAINT FK_5470865E0319FBC');
        $this->addSql('ALTER TABLE membre_equipe DROP CONSTRAINT FK_BE402FAC6A99F74A');
        $this->addSql('ALTER TABLE membre_equipe DROP CONSTRAINT FK_BE402FAC6D861B89');
        $this->addSql('ALTER TABLE membre_groupe DROP CONSTRAINT FK_9EB019986A99F74A');
        $this->addSql('ALTER TABLE membre_groupe DROP CONSTRAINT FK_9EB019987A45358C');
        $this->addSql('ALTER TABLE message DROP CONSTRAINT FK_B6BD307F4795A786');
        $this->addSql('ALTER TABLE message DROP CONSTRAINT FK_B6BD307FB967E626');
        $this->addSql('ALTER TABLE message_groupe DROP CONSTRAINT FK_339E112E60BB6FE6');
        $this->addSql('ALTER TABLE message_groupe DROP CONSTRAINT FK_339E112E7A45358C');
        $this->addSql('ALTER TABLE notification DROP CONSTRAINT FK_BF5476CA60BB6FE6');
        $this->addSql('ALTER TABLE notification DROP CONSTRAINT FK_BF5476CAA96E5E09');
        $this->addSql('ALTER TABLE parcours_employe DROP CONSTRAINT FK_776FEDEF8C03F15C');
        $this->addSql('ALTER TABLE presence DROP CONSTRAINT FK_6977C7A58C03F15C');
        $this->addSql('ALTER TABLE projet DROP CONSTRAINT FK_50159CA953C59D72');
        $this->addSql('ALTER TABLE projet DROP CONSTRAINT FK_50159CA96D861B89');
        $this->addSql('ALTER TABLE projet DROP CONSTRAINT FK_50159CA9DB0C7BBE');
        $this->addSql('ALTER TABLE tache_normale DROP CONSTRAINT FK_82CAE7E68E7B8AB0');
        $this->addSql('ALTER TABLE tache_normale DROP CONSTRAINT FK_82CAE7E6DB0C7BBE');
        $this->addSql('ALTER TABLE tache_projet DROP CONSTRAINT FK_BCE9A3588E7B8AB0');
        $this->addSql('ALTER TABLE tache_projet DROP CONSTRAINT FK_BCE9A358DB0C7BBE');
        $this->addSql('ALTER TABLE tache_projet DROP CONSTRAINT FK_BCE9A358C18272');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D6498C03F15C');
        $this->addSql('DROP TABLE bu');
        $this->addSql('DROP TABLE categorie_fonctionnelle');
        $this->addSql('DROP TABLE commentaire_demande');
        $this->addSql('DROP TABLE conge');
        $this->addSql('DROP TABLE demande_interne');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE employee');
        $this->addSql('DROP TABLE employee_poste');
        $this->addSql('DROP TABLE employee_bu');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE groupe_discussion');
        $this->addSql('DROP TABLE membre_equipe');
        $this->addSql('DROP TABLE membre_groupe');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE message_groupe');
        $this->addSql('DROP TABLE notification');
        $this->addSql('DROP TABLE parcours_employe');
        $this->addSql('DROP TABLE poste');
        $this->addSql('DROP TABLE presence');
        $this->addSql('DROP TABLE projet');
        $this->addSql('DROP TABLE tache_normale');
        $this->addSql('DROP TABLE tache_projet');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
