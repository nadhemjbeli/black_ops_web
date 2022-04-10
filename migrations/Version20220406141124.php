<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220406141124 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipe ADD jeu_Defi INT DEFAULT NULL');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA154188174C FOREIGN KEY (jeu_Defi) REFERENCES jeu (Id_Jeu)');
        $this->addSql('CREATE INDEX IDX_2449BA154188174C ON equipe (jeu_Defi)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA154188174C');
        $this->addSql('DROP INDEX IDX_2449BA154188174C ON equipe');
        $this->addSql('ALTER TABLE equipe DROP jeu_Defi');
    }
}
