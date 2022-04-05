<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220405060958 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE video_uploade CHANGE date_Video date_Video DATETIME DEFAULT CURRENT_TIMESTAMP, CHANGE id_souscat id_souscat INT DEFAULT NULL, CHANGE id_cl id_cl INT DEFAULT NULL');
        $this->addSql('ALTER TABLE video_uploade ADD CONSTRAINT FK_872823E44E74FB40 FOREIGN KEY (id_souscat) REFERENCES sous_categorie (id_SousCat)');
        $this->addSql('ALTER TABLE video_uploade ADD CONSTRAINT FK_872823E48B70FEEF FOREIGN KEY (id_cl) REFERENCES user (id_user)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE video_uploade DROP FOREIGN KEY FK_872823E44E74FB40');
        $this->addSql('ALTER TABLE video_uploade DROP FOREIGN KEY FK_872823E48B70FEEF');
        $this->addSql('ALTER TABLE video_uploade CHANGE id_souscat id_souscat INT NOT NULL, CHANGE id_cl id_cl INT NOT NULL, CHANGE date_Video date_Video DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
    }
}
