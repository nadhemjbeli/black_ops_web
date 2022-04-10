<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220405091917 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id_admin INT AUTO_INCREMENT NOT NULL, mail_admin VARCHAR(254) NOT NULL, password_admin VARCHAR(50) NOT NULL, grade INT NOT NULL, NewPass INT NOT NULL, UNIQUE INDEX mail_admin (mail_admin), PRIMARY KEY(id_admin)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id_cat INT AUTO_INCREMENT NOT NULL, nom_cat VARCHAR(100) NOT NULL, PRIMARY KEY(id_cat)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE champion (Id_Champ INT AUTO_INCREMENT NOT NULL, Nom_Champ VARCHAR(75) NOT NULL, description_Champ LONGTEXT NOT NULL, Role_Champ VARCHAR(75) NOT NULL, Difficulte_Champ VARCHAR(25) NOT NULL, Image_Champ LONGTEXT NOT NULL, Id_jeu INT DEFAULT NULL, INDEX Id_Jeu (Id_jeu), PRIMARY KEY(Id_Champ)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id_Cl INT AUTO_INCREMENT NOT NULL, Pseaudo_Cl VARCHAR(20) NOT NULL, Photo_Cl LONGTEXT NOT NULL, mail_Cl VARCHAR(100) NOT NULL, pass_Cl VARCHAR(300) NOT NULL, DateNaissance_Cl DATE NOT NULL, Statut_Cl VARCHAR(10) DEFAULT \'offline\' NOT NULL, NewPass_Cl INT NOT NULL, UNIQUE INDEX Pseaudo (Pseaudo_Cl), PRIMARY KEY(id_Cl)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id_cl INT DEFAULT NULL, id_Commande INT AUTO_INCREMENT NOT NULL, date_commande DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, Etat_commande VARCHAR(24) NOT NULL, INDEX id_cl (id_cl), PRIMARY KEY(id_Commande)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id_commentaire INT AUTO_INCREMENT NOT NULL, id_livestream INT DEFAULT NULL, contenu_commentaire VARCHAR(250) NOT NULL, date_commentaire DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX id_livestream (id_livestream), PRIMARY KEY(id_commentaire)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id_contact INT AUTO_INCREMENT NOT NULL, np_contact VARCHAR(75) NOT NULL, mail_contact VARCHAR(100) NOT NULL, message LONGTEXT NOT NULL, date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id_contact)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE defi (id_Defi INT AUTO_INCREMENT NOT NULL, nom_Defi VARCHAR(75) NOT NULL, Description_Defi VARCHAR(255) NOT NULL, img_Defi LONGTEXT NOT NULL, prix_Defi INT NOT NULL, date_Defi DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, nbr_equipe_Defi INT NOT NULL, Régle_Defi VARCHAR(1000) NOT NULL, Recompense_Defi VARCHAR(255) NOT NULL, jeu_Defi INT DEFAULT NULL, INDEX defi_jeu (jeu_Defi), UNIQUE INDEX nom_defi (nom_Defi), PRIMARY KEY(id_Defi)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE details_defi (id_defi INT DEFAULT NULL, id_Statistique INT AUTO_INCREMENT NOT NULL, imgScore VARCHAR(255) NOT NULL, Score_finale VARCHAR(255) NOT NULL, EquipeB INT DEFAULT NULL, EquipeA INT DEFAULT NULL, INDEX EquipeB (EquipeB), INDEX id_defi (id_defi), INDEX EquipeA (EquipeA), PRIMARY KEY(id_Statistique)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipe (id_Equipe INT AUTO_INCREMENT NOT NULL, nom_Equipe VARCHAR(100) NOT NULL, logo_Equipe LONGTEXT NOT NULL, date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, nbr_joueur_Equipe INT NOT NULL, PRIMARY KEY(id_Equipe)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (Id_Image INT AUTO_INCREMENT NOT NULL, Url_Image VARCHAR(255) NOT NULL, Id_jeu INT DEFAULT NULL, INDEX Id_jeu (Id_jeu), PRIMARY KEY(Id_Image)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jeu (id_souscat INT DEFAULT NULL, Id_Jeu INT AUTO_INCREMENT NOT NULL, Nom VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, Url VARCHAR(255) NOT NULL, INDEX id_souscat (id_souscat), PRIMARY KEY(Id_Jeu)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE joueur (id_user INT DEFAULT NULL, id_equipe INT DEFAULT NULL, id_Joueur INT AUTO_INCREMENT NOT NULL, nom_Joueur VARCHAR(50) NOT NULL, rang_Joueur VARCHAR(50) NOT NULL, Pseaudo_Joueur VARCHAR(25) NOT NULL, INDEX id_equipe (id_equipe), INDEX user_joueur (id_user), PRIMARY KEY(id_Joueur)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lignecommande (id_commande INT DEFAULT NULL, id_defi INT DEFAULT NULL, id_LigneCommande INT AUTO_INCREMENT NOT NULL, quantite_Billet INT NOT NULL, prix_Billet INT NOT NULL, INDEX id_defi (id_defi), INDEX id_commande (id_commande), PRIMARY KEY(id_LigneCommande)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE live_stream (id_LiveStream INT AUTO_INCREMENT NOT NULL, Nom_LiveStream VARCHAR(100) NOT NULL, Path_LiveStream VARCHAR(500) NOT NULL, Visibilite_LiveStream VARCHAR(150) NOT NULL, id_defi INT NOT NULL, INDEX id_defi (id_defi), PRIMARY KEY(id_LiveStream)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id_message INT AUTO_INCREMENT NOT NULL, id_cl INT DEFAULT NULL, id_souscat INT DEFAULT NULL, date_message DATETIME DEFAULT CURRENT_TIMESTAMP, Contenu_message LONGTEXT NOT NULL, INDEX id_cl (id_cl), INDEX id_souscat (id_souscat), PRIMARY KEY(id_message)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mode (id_mode INT AUTO_INCREMENT NOT NULL, dark_mode INT NOT NULL, light_mode INT DEFAULT 1 NOT NULL, PRIMARY KEY(id_mode)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE replay_stream (id_Replay INT AUTO_INCREMENT NOT NULL, nom_Replay VARCHAR(150) NOT NULL, URL_video VARCHAR(255) NOT NULL, Date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, Description_Replay VARCHAR(300) NOT NULL, vues_Replay INT NOT NULL, id_souscat INT NOT NULL, INDEX id_souscat (id_souscat), PRIMARY KEY(id_Replay)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skin (Id_skin INT AUTO_INCREMENT NOT NULL, image_skin VARCHAR(255) NOT NULL, Id_champ INT NOT NULL, INDEX Id_champ (Id_champ), PRIMARY KEY(Id_skin)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sous_categorie (id_cat INT DEFAULT NULL, id_SousCat INT AUTO_INCREMENT NOT NULL, nom_SousCat VARCHAR(255) DEFAULT NULL, INDEX id_cat (id_cat), PRIMARY KEY(id_SousCat)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stream_info (id_Stream INT AUTO_INCREMENT NOT NULL, nom_Stream VARCHAR(75) NOT NULL, image_Stream VARCHAR(255) NOT NULL, description_Stream LONGTEXT NOT NULL, id_souscat INT NOT NULL, INDEX id_souscat (id_souscat), PRIMARY KEY(id_Stream)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id_user INT AUTO_INCREMENT NOT NULL, mail VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, statut VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, roles JSON NOT NULL, PRIMARY KEY(id_user)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video_uploade (id_souscat INT DEFAULT NULL, id_cl INT DEFAULT NULL, id_Vdeo INT AUTO_INCREMENT NOT NULL, nom_Video VARCHAR(75) NOT NULL, date_Video DATETIME DEFAULT CURRENT_TIMESTAMP, description_Video LONGTEXT NOT NULL, url_Video VARCHAR(255) NOT NULL, INDEX id_souscat (id_souscat), INDEX id_cl (id_cl), PRIMARY KEY(id_Vdeo)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE champion ADD CONSTRAINT FK_45437EB41BEC60D9 FOREIGN KEY (Id_jeu) REFERENCES jeu (Id_Jeu)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D8B70FEEF FOREIGN KEY (id_cl) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC8F81DF4A FOREIGN KEY (id_livestream) REFERENCES live_stream (id_LiveStream)');
        $this->addSql('ALTER TABLE defi ADD CONSTRAINT FK_DCD5A35E4188174C FOREIGN KEY (jeu_Defi) REFERENCES jeu (Id_Jeu)');
        $this->addSql('ALTER TABLE details_defi ADD CONSTRAINT FK_8C6EDD51E8945BFC FOREIGN KEY (EquipeB) REFERENCES equipe (id_Equipe)');
        $this->addSql('ALTER TABLE details_defi ADD CONSTRAINT FK_8C6EDD51719D0A46 FOREIGN KEY (EquipeA) REFERENCES equipe (id_Equipe)');
        $this->addSql('ALTER TABLE details_defi ADD CONSTRAINT FK_8C6EDD5157F5BF5C FOREIGN KEY (id_defi) REFERENCES defi (id_Defi)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F1BEC60D9 FOREIGN KEY (Id_jeu) REFERENCES jeu (Id_Jeu)');
        $this->addSql('ALTER TABLE jeu ADD CONSTRAINT FK_82E48DB54E74FB40 FOREIGN KEY (id_souscat) REFERENCES sous_categorie (id_SousCat)');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C56B3CA4B FOREIGN KEY (id_user) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C527E0FF8 FOREIGN KEY (id_equipe) REFERENCES equipe (id_Equipe)');
        $this->addSql('ALTER TABLE lignecommande ADD CONSTRAINT FK_853B79393E314AE8 FOREIGN KEY (id_commande) REFERENCES commande (id_Commande)');
        $this->addSql('ALTER TABLE lignecommande ADD CONSTRAINT FK_853B793957F5BF5C FOREIGN KEY (id_defi) REFERENCES defi (id_Defi)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F8B70FEEF FOREIGN KEY (id_cl) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F4E74FB40 FOREIGN KEY (id_souscat) REFERENCES sous_categorie (id_SousCat)');
        $this->addSql('ALTER TABLE sous_categorie ADD CONSTRAINT FK_52743D7BFAABF2 FOREIGN KEY (id_cat) REFERENCES categorie (id_cat)');
        $this->addSql('ALTER TABLE video_uploade ADD CONSTRAINT FK_872823E44E74FB40 FOREIGN KEY (id_souscat) REFERENCES sous_categorie (id_SousCat)');
        $this->addSql('ALTER TABLE video_uploade ADD CONSTRAINT FK_872823E48B70FEEF FOREIGN KEY (id_cl) REFERENCES user (id_user)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sous_categorie DROP FOREIGN KEY FK_52743D7BFAABF2');
        $this->addSql('ALTER TABLE lignecommande DROP FOREIGN KEY FK_853B79393E314AE8');
        $this->addSql('ALTER TABLE details_defi DROP FOREIGN KEY FK_8C6EDD5157F5BF5C');
        $this->addSql('ALTER TABLE lignecommande DROP FOREIGN KEY FK_853B793957F5BF5C');
        $this->addSql('ALTER TABLE details_defi DROP FOREIGN KEY FK_8C6EDD51E8945BFC');
        $this->addSql('ALTER TABLE details_defi DROP FOREIGN KEY FK_8C6EDD51719D0A46');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C527E0FF8');
        $this->addSql('ALTER TABLE champion DROP FOREIGN KEY FK_45437EB41BEC60D9');
        $this->addSql('ALTER TABLE defi DROP FOREIGN KEY FK_DCD5A35E4188174C');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F1BEC60D9');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC8F81DF4A');
        $this->addSql('ALTER TABLE jeu DROP FOREIGN KEY FK_82E48DB54E74FB40');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F4E74FB40');
        $this->addSql('ALTER TABLE video_uploade DROP FOREIGN KEY FK_872823E44E74FB40');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D8B70FEEF');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C56B3CA4B');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F8B70FEEF');
        $this->addSql('ALTER TABLE video_uploade DROP FOREIGN KEY FK_872823E48B70FEEF');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE champion');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE defi');
        $this->addSql('DROP TABLE details_defi');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE jeu');
        $this->addSql('DROP TABLE joueur');
        $this->addSql('DROP TABLE lignecommande');
        $this->addSql('DROP TABLE live_stream');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE mode');
        $this->addSql('DROP TABLE replay_stream');
        $this->addSql('DROP TABLE skin');
        $this->addSql('DROP TABLE sous_categorie');
        $this->addSql('DROP TABLE stream_info');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE video_uploade');
    }
}
