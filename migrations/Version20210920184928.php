<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210920184928 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE festivals ADD editor_id INT NOT NULL');
        $this->addSql('ALTER TABLE festivals ADD CONSTRAINT FK_8F6F88786995AC4C FOREIGN KEY (editor_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8F6F88786995AC4C ON festivals (editor_id)');
        $this->addSql('ALTER TABLE news ADD festival_id INT NOT NULL');
        $this->addSql('ALTER TABLE news ADD CONSTRAINT FK_1DD399508AEBAF57 FOREIGN KEY (festival_id) REFERENCES festivals (id)');
        $this->addSql('CREATE INDEX IDX_1DD399508AEBAF57 ON news (festival_id)');
        $this->addSql('ALTER TABLE pictures ADD festival_id INT NOT NULL');
        $this->addSql('ALTER TABLE pictures ADD CONSTRAINT FK_8F7C2FC08AEBAF57 FOREIGN KEY (festival_id) REFERENCES festivals (id)');
        $this->addSql('CREATE INDEX IDX_8F7C2FC08AEBAF57 ON pictures (festival_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE festivals DROP FOREIGN KEY FK_8F6F88786995AC4C');
        $this->addSql('DROP INDEX IDX_8F6F88786995AC4C ON festivals');
        $this->addSql('ALTER TABLE festivals DROP editor_id');
        $this->addSql('ALTER TABLE news DROP FOREIGN KEY FK_1DD399508AEBAF57');
        $this->addSql('DROP INDEX IDX_1DD399508AEBAF57 ON news');
        $this->addSql('ALTER TABLE news DROP festival_id');
        $this->addSql('ALTER TABLE pictures DROP FOREIGN KEY FK_8F7C2FC08AEBAF57');
        $this->addSql('DROP INDEX IDX_8F7C2FC08AEBAF57 ON pictures');
        $this->addSql('ALTER TABLE pictures DROP festival_id');
    }
}
