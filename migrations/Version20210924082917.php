<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210924082917 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE news CHANGE festival_id festival_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pictures DROP FOREIGN KEY FK_8F7C2FC08AEBAF57');
        $this->addSql('ALTER TABLE pictures ADD CONSTRAINT FK_8F7C2FC08AEBAF57 FOREIGN KEY (festival_id) REFERENCES festivals (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE news CHANGE festival_id festival_id INT NOT NULL');
        $this->addSql('ALTER TABLE pictures DROP FOREIGN KEY FK_8F7C2FC08AEBAF57');
        $this->addSql('ALTER TABLE pictures ADD CONSTRAINT FK_8F7C2FC08AEBAF57 FOREIGN KEY (festival_id) REFERENCES festivals (id)');
    }
}
