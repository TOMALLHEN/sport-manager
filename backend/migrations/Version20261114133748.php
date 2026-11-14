<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261114133748 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE joueur ADD equipe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE joueur ADD poste_id INT NOT NULL');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C56D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C5A0905086 FOREIGN KEY (poste_id) REFERENCES poste (id) NOT DEFERRABLE');
        $this->addSql('CREATE INDEX IDX_FD71A9C56D861B89 ON joueur (equipe_id)');
        $this->addSql('CREATE INDEX IDX_FD71A9C5A0905086 ON joueur (poste_id)');
        $this->addSql('ALTER TABLE match_equipe ADD equipe_domicile_id INT NOT NULL');
        $this->addSql('ALTER TABLE match_equipe ADD equipe_exterieure_id INT NOT NULL');
        $this->addSql('ALTER TABLE match_equipe ADD CONSTRAINT FK_852643145FE1AEAD FOREIGN KEY (equipe_domicile_id) REFERENCES equipe (id) NOT DEFERRABLE');
        $this->addSql('ALTER TABLE match_equipe ADD CONSTRAINT FK_852643148923FCCA FOREIGN KEY (equipe_exterieure_id) REFERENCES equipe (id) NOT DEFERRABLE');
        $this->addSql('CREATE INDEX IDX_852643145FE1AEAD ON match_equipe (equipe_domicile_id)');
        $this->addSql('CREATE INDEX IDX_852643148923FCCA ON match_equipe (equipe_exterieure_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE joueur DROP CONSTRAINT FK_FD71A9C56D861B89');
        $this->addSql('ALTER TABLE joueur DROP CONSTRAINT FK_FD71A9C5A0905086');
        $this->addSql('DROP INDEX IDX_FD71A9C56D861B89');
        $this->addSql('DROP INDEX IDX_FD71A9C5A0905086');
        $this->addSql('ALTER TABLE joueur DROP equipe_id');
        $this->addSql('ALTER TABLE joueur DROP poste_id');
        $this->addSql('ALTER TABLE match_equipe DROP CONSTRAINT FK_852643145FE1AEAD');
        $this->addSql('ALTER TABLE match_equipe DROP CONSTRAINT FK_852643148923FCCA');
        $this->addSql('DROP INDEX IDX_852643145FE1AEAD');
        $this->addSql('DROP INDEX IDX_852643148923FCCA');
        $this->addSql('ALTER TABLE match_equipe DROP equipe_domicile_id');
        $this->addSql('ALTER TABLE match_equipe DROP equipe_exterieure_id');
    }
}
