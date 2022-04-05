<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220404204343 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin CHANGE NewPass NewPass INT NOT NULL');
        $this->addSql('ALTER TABLE categorie CHANGE nom_cat nom_cat VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE champion CHANGE Id_jeu Id_jeu INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client CHANGE NewPass_Cl NewPass_Cl INT NOT NULL');
        $this->addSql('ALTER TABLE commande CHANGE id_cl id_cl INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaire CHANGE id_livestream id_livestream INT DEFAULT NULL');
        $this->addSql('ALTER TABLE defi DROP FOREIGN KEY defi_jeu');
        $this->addSql('ALTER TABLE defi CHANGE jeu_Defi jeu_Defi INT DEFAULT NULL');
        $this->addSql('ALTER TABLE defi ADD CONSTRAINT FK_DCD5A35E4188174C FOREIGN KEY (jeu_Defi) REFERENCES jeu (Id_Jeu)');
        $this->addSql('ALTER TABLE details_defi CHANGE id_defi id_defi INT DEFAULT NULL, CHANGE EquipeA EquipeA INT DEFAULT NULL, CHANGE EquipeB EquipeB INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image CHANGE Id_jeu Id_jeu INT DEFAULT NULL');
        $this->addSql('ALTER TABLE jeu CHANGE id_souscat id_souscat INT DEFAULT NULL');
        $this->addSql('ALTER TABLE joueur CHANGE id_equipe id_equipe INT DEFAULT NULL, CHANGE id_user id_user INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lignecommande CHANGE id_defi id_defi INT DEFAULT NULL, CHANGE id_commande id_commande INT DEFAULT NULL');
        $this->addSql('ALTER TABLE message CHANGE id_cl id_cl INT DEFAULT NULL, CHANGE id_souscat id_souscat INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mode CHANGE dark_mode dark_mode INT NOT NULL');
        $this->addSql('ALTER TABLE replay_stream CHANGE vues_Replay vues_Replay INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin CHANGE NewPass NewPass INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE categorie CHANGE nom_cat nom_cat VARCHAR(100) NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE champion CHANGE Id_jeu Id_jeu INT NOT NULL');
        $this->addSql('ALTER TABLE client CHANGE NewPass_Cl NewPass_Cl INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE commande CHANGE id_cl id_cl INT NOT NULL');
        $this->addSql('ALTER TABLE commentaire CHANGE id_livestream id_livestream INT NOT NULL');
        $this->addSql('ALTER TABLE defi DROP FOREIGN KEY FK_DCD5A35E4188174C');
        $this->addSql('ALTER TABLE defi CHANGE jeu_Defi jeu_Defi INT NOT NULL');
        $this->addSql('ALTER TABLE defi ADD CONSTRAINT defi_jeu FOREIGN KEY (jeu_Defi) REFERENCES jeu (Id_Jeu) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE details_defi CHANGE id_defi id_defi INT NOT NULL, CHANGE EquipeB EquipeB INT NOT NULL, CHANGE EquipeA EquipeA INT NOT NULL');
        $this->addSql('ALTER TABLE image CHANGE Id_jeu Id_jeu INT NOT NULL');
        $this->addSql('ALTER TABLE jeu CHANGE id_souscat id_souscat INT NOT NULL');
        $this->addSql('ALTER TABLE joueur CHANGE id_user id_user INT NOT NULL, CHANGE id_equipe id_equipe INT NOT NULL');
        $this->addSql('ALTER TABLE lignecommande CHANGE id_commande id_commande INT NOT NULL, CHANGE id_defi id_defi INT NOT NULL');
        $this->addSql('ALTER TABLE message CHANGE id_cl id_cl INT NOT NULL, CHANGE id_souscat id_souscat INT NOT NULL');
        $this->addSql('ALTER TABLE mode CHANGE dark_mode dark_mode INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE replay_stream CHANGE vues_Replay vues_Replay INT DEFAULT 0 NOT NULL');
    }
}
