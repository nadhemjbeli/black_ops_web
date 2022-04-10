<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220409032850 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE defi DROP FOREIGN KEY FK_DCD5A35E4188174C');
        $this->addSql('ALTER TABLE defi ADD CONSTRAINT FK_DCD5A35E4188174C FOREIGN KEY (jeu_Defi) REFERENCES jeu (Id_Jeu)');
        $this->addSql('ALTER TABLE details_defi ADD date DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE defi DROP FOREIGN KEY FK_DCD5A35E4188174C');
        $this->addSql('ALTER TABLE defi ADD CONSTRAINT FK_DCD5A35E4188174C FOREIGN KEY (jeu_Defi) REFERENCES jeu (Id_Jeu) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE details_defi DROP date');
    }
}
