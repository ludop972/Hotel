<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220627223915 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE room_informations_of_rooms (room_id INT NOT NULL, informations_of_rooms_id INT NOT NULL, INDEX IDX_EDDB85BB54177093 (room_id), INDEX IDX_EDDB85BB3E092AAE (informations_of_rooms_id), PRIMARY KEY(room_id, informations_of_rooms_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE room_informations_of_rooms ADD CONSTRAINT FK_EDDB85BB54177093 FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE room_informations_of_rooms ADD CONSTRAINT FK_EDDB85BB3E092AAE FOREIGN KEY (informations_of_rooms_id) REFERENCES informations_of_rooms (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE informations_of_rooms DROP FOREIGN KEY FK_6F9E0B454177093');
        $this->addSql('DROP INDEX IDX_6F9E0B454177093 ON informations_of_rooms');
        $this->addSql('ALTER TABLE informations_of_rooms DROP room_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE room_informations_of_rooms');
        $this->addSql('ALTER TABLE informations_of_rooms ADD room_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE informations_of_rooms ADD CONSTRAINT FK_6F9E0B454177093 FOREIGN KEY (room_id) REFERENCES room (id)');
        $this->addSql('CREATE INDEX IDX_6F9E0B454177093 ON informations_of_rooms (room_id)');
    }
}
