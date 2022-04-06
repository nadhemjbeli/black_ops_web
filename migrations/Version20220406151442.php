<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220406151442 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE skin CHANGE Id_champ Id_Champ INT DEFAULT NULL');
        $this->addSql('ALTER TABLE skin ADD CONSTRAINT FK_279681EF953ECCF FOREIGN KEY (Id_Champ) REFERENCES champion (Id_Champ)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE skin DROP FOREIGN KEY FK_279681EF953ECCF');
        $this->addSql('ALTER TABLE skin CHANGE Id_Champ Id_champ INT NOT NULL');
    }
}
