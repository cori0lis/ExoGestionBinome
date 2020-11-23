<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201123133007 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE duree (id INT AUTO_INCREMENT NOT NULL, formation_id INT DEFAULT NULL, modules_id INT DEFAULT NULL, nb_jours INT NOT NULL, INDEX IDX_8456C0355200282E (formation_id), INDEX IDX_8456C03560D6DC42 (modules_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_C242628BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, formation_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, nombre_places INT NOT NULL, INDEX IDX_D044D5D45200282E (formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session_stagiaire (session_id INT NOT NULL, stagiaire_id INT NOT NULL, INDEX IDX_C80B23B613FECDF (session_id), INDEX IDX_C80B23BBBA93DD6 (stagiaire_id), PRIMARY KEY(session_id, stagiaire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stagiaire (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, civilite VARCHAR(1) NOT NULL, date_naissance DATE NOT NULL, ville VARCHAR(100) NOT NULL, adresse VARCHAR(100) NOT NULL, cp VARCHAR(20) NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, civilite VARCHAR(1) NOT NULL, date_naissance DATE NOT NULL, ville VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, cp VARCHAR(255) NOT NULL, telephone VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B3E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur_categorie (utilisateur_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_29D32318FB88E14F (utilisateur_id), INDEX IDX_29D32318BCF5E72D (categorie_id), PRIMARY KEY(utilisateur_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE duree ADD CONSTRAINT FK_8456C0355200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE duree ADD CONSTRAINT FK_8456C03560D6DC42 FOREIGN KEY (modules_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C242628BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D45200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE session_stagiaire ADD CONSTRAINT FK_C80B23B613FECDF FOREIGN KEY (session_id) REFERENCES session (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE session_stagiaire ADD CONSTRAINT FK_C80B23BBBA93DD6 FOREIGN KEY (stagiaire_id) REFERENCES stagiaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_categorie ADD CONSTRAINT FK_29D32318FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_categorie ADD CONSTRAINT FK_29D32318BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C242628BCF5E72D');
        $this->addSql('ALTER TABLE utilisateur_categorie DROP FOREIGN KEY FK_29D32318BCF5E72D');
        $this->addSql('ALTER TABLE duree DROP FOREIGN KEY FK_8456C0355200282E');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D45200282E');
        $this->addSql('ALTER TABLE duree DROP FOREIGN KEY FK_8456C03560D6DC42');
        $this->addSql('ALTER TABLE session_stagiaire DROP FOREIGN KEY FK_C80B23B613FECDF');
        $this->addSql('ALTER TABLE session_stagiaire DROP FOREIGN KEY FK_C80B23BBBA93DD6');
        $this->addSql('ALTER TABLE utilisateur_categorie DROP FOREIGN KEY FK_29D32318FB88E14F');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE duree');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE session_stagiaire');
        $this->addSql('DROP TABLE stagiaire');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE utilisateur_categorie');
    }
}
