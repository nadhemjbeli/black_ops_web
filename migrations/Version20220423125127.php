<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220423125127 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE defi CHANGE date_Defi date_Defi DATETIME DEFAULT CURRENT_TIMESTAMP, CHANGE Régle_Defi Regle_Defi VARCHAR(1000) NOT NULL');
        $this->addSql('ALTER TABLE details_defi ADD date DATETIME NOT NULL, CHANGE imgScore imgScore VARCHAR(255) DEFAULT NULL, CHANGE Score_finale Score_finale VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE defi CHANGE date_Defi date_Defi DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE Regle_Defi Régle_Defi VARCHAR(1000) NOT NULL');
        $this->addSql('ALTER TABLE details_defi DROP date, CHANGE imgScore imgScore VARCHAR(255) NOT NULL, CHANGE Score_finale Score_finale VARCHAR(255) NOT NULL');
    }
}
