<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220623180044 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE informations_of_rooms (id INT AUTO_INCREMENT NOT NULL, room_id INT DEFAULT NULL, size VARCHAR(255) NOT NULL, bed VARCHAR(255) NOT NULL, outside VARCHAR(255) DEFAULT NULL, tools VARCHAR(255) DEFAULT NULL, tv VARCHAR(255) DEFAULT NULL, foods VARCHAR(255) DEFAULT NULL, capacity VARCHAR(255) NOT NULL, internet VARCHAR(255) NOT NULL, bathroom VARCHAR(255) NOT NULL, cooling VARCHAR(255) NOT NULL, short_drinks VARCHAR(255) DEFAULT NULL, INDEX IDX_6F9E0B454177093 (room_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE informations_of_rooms ADD CONSTRAINT FK_6F9E0B454177093 FOREIGN KEY (room_id) REFERENCES room (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE informations_of_rooms');
    }
}
