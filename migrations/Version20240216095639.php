<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240216095639 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE faire_partie_matiere (faire_partie_id INT NOT NULL, matiere_id INT NOT NULL, INDEX IDX_2B2D199D883237C1 (faire_partie_id), INDEX IDX_2B2D199DF46CD258 (matiere_id), PRIMARY KEY(faire_partie_id, matiere_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE faire_partie_matiere ADD CONSTRAINT FK_2B2D199D883237C1 FOREIGN KEY (faire_partie_id) REFERENCES faire_partie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE faire_partie_matiere ADD CONSTRAINT FK_2B2D199DF46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE faire_partie DROP FOREIGN KEY FK_27880B8982350831');
        $this->addSql('DROP INDEX IDX_27880B8982350831 ON faire_partie');
        $this->addSql('ALTER TABLE faire_partie DROP matieres_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE faire_partie_matiere DROP FOREIGN KEY FK_2B2D199D883237C1');
        $this->addSql('ALTER TABLE faire_partie_matiere DROP FOREIGN KEY FK_2B2D199DF46CD258');
        $this->addSql('DROP TABLE faire_partie_matiere');
        $this->addSql('ALTER TABLE faire_partie ADD matieres_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE faire_partie ADD CONSTRAINT FK_27880B8982350831 FOREIGN KEY (matieres_id) REFERENCES matiere (id)');
        $this->addSql('CREATE INDEX IDX_27880B8982350831 ON faire_partie (matieres_id)');
    }
}
