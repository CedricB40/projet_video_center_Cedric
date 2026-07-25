<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260725134824 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'ajout de la relation ManyToOne entre videos et users (colonne auteur_id)';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE videos ADD auteur_id INT NOT NULL');
        $this->addSql('ALTER TABLE videos ADD CONSTRAINT FK_29AA643260BB6FE6 FOREIGN KEY (auteur_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_29AA643260BB6FE6 ON videos (auteur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE videos DROP FOREIGN KEY FK_29AA643260BB6FE6');
        $this->addSql('DROP INDEX IDX_29AA643260BB6FE6 ON videos');
        $this->addSql('ALTER TABLE videos DROP auteur_id');
    }
}
