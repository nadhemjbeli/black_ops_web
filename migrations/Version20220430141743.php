<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220430141743 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE like_message (id INT AUTO_INCREMENT NOT NULL, id_cl INT DEFAULT NULL, id_message INT DEFAULT NULL, react INT NOT NULL, INDEX IDX_E5307A5C8B70FEEF (id_cl), INDEX IDX_E5307A5C6820990F (id_message), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE like_message ADD CONSTRAINT FK_E5307A5C8B70FEEF FOREIGN KEY (id_cl) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE like_message ADD CONSTRAINT FK_E5307A5C6820990F FOREIGN KEY (id_message) REFERENCES message (id_message)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE like_message');
    }
}
