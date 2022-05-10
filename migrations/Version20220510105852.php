<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220510105852 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
//        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id_user)');
//        $this->addSql('ALTER TABLE equipe CHANGE date date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
//        $this->addSql('ALTER TABLE reclamation CHANGE id_cl id_cl INT DEFAULT NULL');
//        $this->addSql('ALTER TABLE skin CHANGE Id_champ Id_Champ INT DEFAULT NULL');
//        $this->addSql('ALTER TABLE skin ADD CONSTRAINT FK_279681EF953ECCF FOREIGN KEY (Id_Champ) REFERENCES champion (Id_Champ)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('ALTER TABLE equipe CHANGE date date DATETIME DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE reclamation CHANGE id_cl id_cl INT NOT NULL');
        $this->addSql('ALTER TABLE skin DROP FOREIGN KEY FK_279681EF953ECCF');
        $this->addSql('ALTER TABLE skin CHANGE Id_Champ Id_champ INT NOT NULL');
    }
}
