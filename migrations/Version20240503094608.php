<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240503094608 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avoir_note (id INT AUTO_INCREMENT NOT NULL, note NUMERIC(4, 2) DEFAULT NULL, apprenants_id INT DEFAULT NULL, matieres_id INT DEFAULT NULL, INDEX IDX_5BA3D79ED4B7C9BD (apprenants_id), INDEX IDX_5BA3D79E82350831 (matieres_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(55) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE matiere (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(55) NOT NULL, formateurs_id INT DEFAULT NULL, INDEX IDX_9014574AFB0881C8 (formateurs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, programme LONGTEXT DEFAULT NULL, matiere_id INT DEFAULT NULL, formation_id INT DEFAULT NULL, INDEX IDX_C242628F46CD258 (matiere_id), INDEX IDX_C2426285200282E (formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(55) NOT NULL, prenom VARCHAR(55) NOT NULL, formation_id INT DEFAULT NULL, tuteur_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_1D1C63B3E7927C74 (email), INDEX IDX_1D1C63B35200282E (formation_id), INDEX IDX_1D1C63B386EC68D8 (tuteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE avoir_note ADD CONSTRAINT FK_5BA3D79ED4B7C9BD FOREIGN KEY (apprenants_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE avoir_note ADD CONSTRAINT FK_5BA3D79E82350831 FOREIGN KEY (matieres_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE matiere ADD CONSTRAINT FK_9014574AFB0881C8 FOREIGN KEY (formateurs_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C242628F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C2426285200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B35200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B386EC68D8 FOREIGN KEY (tuteur_id) REFERENCES utilisateur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avoir_note DROP FOREIGN KEY FK_5BA3D79ED4B7C9BD');
        $this->addSql('ALTER TABLE avoir_note DROP FOREIGN KEY FK_5BA3D79E82350831');
        $this->addSql('ALTER TABLE matiere DROP FOREIGN KEY FK_9014574AFB0881C8');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C242628F46CD258');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C2426285200282E');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B35200282E');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B386EC68D8');
        $this->addSql('DROP TABLE avoir_note');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
