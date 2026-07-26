<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260726071432 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'ajout de la colonne image sur la table users pour VichUploader';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users ADD image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE videos CHANGE premium_video premium_video TINYINT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users DROP image');
        $this->addSql('ALTER TABLE videos CHANGE premium_video premium_video TINYINT DEFAULT 0 NOT NULL');
    }
}