<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240209151639 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avoir_note ADD apprenants_id INT DEFAULT NULL, ADD matieres_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE avoir_note ADD CONSTRAINT FK_5BA3D79ED4B7C9BD FOREIGN KEY (apprenants_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE avoir_note ADD CONSTRAINT FK_5BA3D79E82350831 FOREIGN KEY (matieres_id) REFERENCES matiere (id)');
        $this->addSql('CREATE INDEX IDX_5BA3D79ED4B7C9BD ON avoir_note (apprenants_id)');
        $this->addSql('CREATE INDEX IDX_5BA3D79E82350831 ON avoir_note (matieres_id)');
        $this->addSql('ALTER TABLE faire_partie ADD programme LONGTEXT DEFAULT NULL, ADD matieres_id INT DEFAULT NULL, ADD formations_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE faire_partie ADD CONSTRAINT FK_27880B8982350831 FOREIGN KEY (matieres_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE faire_partie ADD CONSTRAINT FK_27880B893BF5B0C2 FOREIGN KEY (formations_id) REFERENCES formation (id)');
        $this->addSql('CREATE INDEX IDX_27880B8982350831 ON faire_partie (matieres_id)');
        $this->addSql('CREATE INDEX IDX_27880B893BF5B0C2 ON faire_partie (formations_id)');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF883237C1');
        $this->addSql('DROP INDEX IDX_404021BF883237C1 ON formation');
        $this->addSql('ALTER TABLE formation DROP faire_partie_id, CHANGE nom nom VARCHAR(55) NOT NULL');
        $this->addSql('ALTER TABLE matiere DROP FOREIGN KEY FK_9014574A106AF11B');
        $this->addSql('ALTER TABLE matiere DROP FOREIGN KEY FK_9014574A155D8F51');
        $this->addSql('ALTER TABLE matiere DROP FOREIGN KEY FK_9014574A883237C1');
        $this->addSql('DROP INDEX IDX_9014574A155D8F51 ON matiere');
        $this->addSql('DROP INDEX IDX_9014574A106AF11B ON matiere');
        $this->addSql('DROP INDEX IDX_9014574A883237C1 ON matiere');
        $this->addSql('ALTER TABLE matiere ADD formateurs_id INT DEFAULT NULL, DROP programme, DROP formateur_id, DROP avoir_note_id, DROP faire_partie_id, CHANGE nom nom VARCHAR(55) NOT NULL');
        $this->addSql('ALTER TABLE matiere ADD CONSTRAINT FK_9014574AFB0881C8 FOREIGN KEY (formateurs_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_9014574AFB0881C8 ON matiere (formateurs_id)');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3106AF11B');
        $this->addSql('DROP INDEX IDX_1D1C63B3106AF11B ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP avoir_note_id, CHANGE nom nom VARCHAR(55) NOT NULL, CHANGE prenom prenom VARCHAR(55) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avoir_note DROP FOREIGN KEY FK_5BA3D79ED4B7C9BD');
        $this->addSql('ALTER TABLE avoir_note DROP FOREIGN KEY FK_5BA3D79E82350831');
        $this->addSql('DROP INDEX IDX_5BA3D79ED4B7C9BD ON avoir_note');
        $this->addSql('DROP INDEX IDX_5BA3D79E82350831 ON avoir_note');
        $this->addSql('ALTER TABLE avoir_note DROP apprenants_id, DROP matieres_id');
        $this->addSql('ALTER TABLE faire_partie DROP FOREIGN KEY FK_27880B8982350831');
        $this->addSql('ALTER TABLE faire_partie DROP FOREIGN KEY FK_27880B893BF5B0C2');
        $this->addSql('DROP INDEX IDX_27880B8982350831 ON faire_partie');
        $this->addSql('DROP INDEX IDX_27880B893BF5B0C2 ON faire_partie');
        $this->addSql('ALTER TABLE faire_partie DROP programme, DROP matieres_id, DROP formations_id');
        $this->addSql('ALTER TABLE formation ADD faire_partie_id INT DEFAULT NULL, CHANGE nom nom VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF883237C1 FOREIGN KEY (faire_partie_id) REFERENCES faire_partie (id)');
        $this->addSql('CREATE INDEX IDX_404021BF883237C1 ON formation (faire_partie_id)');
        $this->addSql('ALTER TABLE matiere DROP FOREIGN KEY FK_9014574AFB0881C8');
        $this->addSql('DROP INDEX IDX_9014574AFB0881C8 ON matiere');
        $this->addSql('ALTER TABLE matiere ADD programme LONGTEXT DEFAULT NULL, ADD avoir_note_id INT DEFAULT NULL, ADD faire_partie_id INT DEFAULT NULL, CHANGE nom nom VARCHAR(50) NOT NULL, CHANGE formateurs_id formateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE matiere ADD CONSTRAINT FK_9014574A106AF11B FOREIGN KEY (avoir_note_id) REFERENCES avoir_note (id)');
        $this->addSql('ALTER TABLE matiere ADD CONSTRAINT FK_9014574A155D8F51 FOREIGN KEY (formateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE matiere ADD CONSTRAINT FK_9014574A883237C1 FOREIGN KEY (faire_partie_id) REFERENCES faire_partie (id)');
        $this->addSql('CREATE INDEX IDX_9014574A155D8F51 ON matiere (formateur_id)');
        $this->addSql('CREATE INDEX IDX_9014574A106AF11B ON matiere (avoir_note_id)');
        $this->addSql('CREATE INDEX IDX_9014574A883237C1 ON matiere (faire_partie_id)');
        $this->addSql('ALTER TABLE utilisateur ADD avoir_note_id INT DEFAULT NULL, CHANGE nom nom VARCHAR(50) NOT NULL, CHANGE prenom prenom VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3106AF11B FOREIGN KEY (avoir_note_id) REFERENCES avoir_note (id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B3106AF11B ON utilisateur (avoir_note_id)');
    }
}
