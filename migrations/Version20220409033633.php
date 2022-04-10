<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220409033633 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipe ADD JeuV INT DEFAULT NULL');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA154BB117FC FOREIGN KEY (JeuV) REFERENCES jeu (Id_Jeu)');
        $this->addSql('CREATE INDEX IDX_2449BA154BB117FC ON equipe (JeuV)');
        $this->addSql('ALTER TABLE sous_categorie ADD CONSTRAINT FK_52743D7BFAABF2 FOREIGN KEY (id_cat) REFERENCES categorie (id_cat)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA154BB117FC');
        $this->addSql('DROP INDEX IDX_2449BA154BB117FC ON equipe');
        $this->addSql('ALTER TABLE equipe DROP JeuV');
        $this->addSql('ALTER TABLE sous_categorie DROP FOREIGN KEY FK_52743D7BFAABF2');
    }
}
