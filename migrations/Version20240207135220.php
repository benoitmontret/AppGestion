<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240207135220 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avoir_note (id INT AUTO_INCREMENT NOT NULL, note NUMERIC(4, 2) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE faire_partie (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, faire_partie_id INT DEFAULT NULL, INDEX IDX_404021BF883237C1 (faire_partie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE matiere (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, programme LONGTEXT DEFAULT NULL, formateur_id INT DEFAULT NULL, avoir_note_id INT DEFAULT NULL, faire_partie_id INT DEFAULT NULL, INDEX IDX_9014574A155D8F51 (formateur_id), INDEX IDX_9014574A106AF11B (avoir_note_id), INDEX IDX_9014574A883237C1 (faire_partie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, avoir_note_id INT DEFAULT NULL, formation_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_1D1C63B3E7927C74 (email), INDEX IDX_1D1C63B3106AF11B (avoir_note_id), INDEX IDX_1D1C63B35200282E (formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF883237C1 FOREIGN KEY (faire_partie_id) REFERENCES faire_partie (id)');
        $this->addSql('ALTER TABLE matiere ADD CONSTRAINT FK_9014574A155D8F51 FOREIGN KEY (formateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE matiere ADD CONSTRAINT FK_9014574A106AF11B FOREIGN KEY (avoir_note_id) REFERENCES avoir_note (id)');
        $this->addSql('ALTER TABLE matiere ADD CONSTRAINT FK_9014574A883237C1 FOREIGN KEY (faire_partie_id) REFERENCES faire_partie (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3106AF11B FOREIGN KEY (avoir_note_id) REFERENCES avoir_note (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B35200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF883237C1');
        $this->addSql('ALTER TABLE matiere DROP FOREIGN KEY FK_9014574A155D8F51');
        $this->addSql('ALTER TABLE matiere DROP FOREIGN KEY FK_9014574A106AF11B');
        $this->addSql('ALTER TABLE matiere DROP FOREIGN KEY FK_9014574A883237C1');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3106AF11B');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B35200282E');
        $this->addSql('DROP TABLE avoir_note');
        $this->addSql('DROP TABLE faire_partie');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
