<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240515111842 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE marque ADD model_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE marque ADD CONSTRAINT FK_5A6F91CE7975B7E7 FOREIGN KEY (model_id) REFERENCES model (id)');
        $this->addSql('CREATE INDEX IDX_5A6F91CE7975B7E7 ON marque (model_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE marque DROP FOREIGN KEY FK_5A6F91CE7975B7E7');
        $this->addSql('DROP INDEX IDX_5A6F91CE7975B7E7 ON marque');
        $this->addSql('ALTER TABLE marque DROP model_id');
    }
}
