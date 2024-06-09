<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240515111644 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voiture ADD id_model_id INT NOT NULL');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810F29AE5B72 FOREIGN KEY (id_model_id) REFERENCES model (id)');
        $this->addSql('CREATE INDEX IDX_E9E2810F29AE5B72 ON voiture (id_model_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810F29AE5B72');
        $this->addSql('DROP INDEX IDX_E9E2810F29AE5B72 ON voiture');
        $this->addSql('ALTER TABLE voiture DROP id_model_id');
    }
}
