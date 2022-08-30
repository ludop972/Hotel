<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220625160714 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE room_imgs (room_id INT NOT NULL, imgs_id INT NOT NULL, INDEX IDX_A7D1086454177093 (room_id), INDEX IDX_A7D10864FCB072C1 (imgs_id), PRIMARY KEY(room_id, imgs_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE room_imgs ADD CONSTRAINT FK_A7D1086454177093 FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE room_imgs ADD CONSTRAINT FK_A7D10864FCB072C1 FOREIGN KEY (imgs_id) REFERENCES imgs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE imgs DROP FOREIGN KEY FK_C4D5E20054177093');
        $this->addSql('DROP INDEX IDX_C4D5E20054177093 ON imgs');
        $this->addSql('ALTER TABLE imgs DROP room_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE room_imgs');
        $this->addSql('ALTER TABLE imgs ADD room_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE imgs ADD CONSTRAINT FK_C4D5E20054177093 FOREIGN KEY (room_id) REFERENCES room (id)');
        $this->addSql('CREATE INDEX IDX_C4D5E20054177093 ON imgs (room_id)');
    }
}
