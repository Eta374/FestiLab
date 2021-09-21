<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210920184138 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artists_festivals (artists_id INT NOT NULL, festivals_id INT NOT NULL, INDEX IDX_AD0AEB0C54A05007 (artists_id), INDEX IDX_AD0AEB0C12F492DD (festivals_id), PRIMARY KEY(artists_id, festivals_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE places_festivals (places_id INT NOT NULL, festivals_id INT NOT NULL, INDEX IDX_60B5A27D8317B347 (places_id), INDEX IDX_60B5A27D12F492DD (festivals_id), PRIMARY KEY(places_id, festivals_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artists_festivals ADD CONSTRAINT FK_AD0AEB0C54A05007 FOREIGN KEY (artists_id) REFERENCES artists (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artists_festivals ADD CONSTRAINT FK_AD0AEB0C12F492DD FOREIGN KEY (festivals_id) REFERENCES festivals (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE places_festivals ADD CONSTRAINT FK_60B5A27D8317B347 FOREIGN KEY (places_id) REFERENCES places (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE places_festivals ADD CONSTRAINT FK_60B5A27D12F492DD FOREIGN KEY (festivals_id) REFERENCES festivals (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE festivals ADD kind_id INT NOT NULL, ADD public_id INT NOT NULL');
        $this->addSql('ALTER TABLE festivals ADD CONSTRAINT FK_8F6F887830602CA9 FOREIGN KEY (kind_id) REFERENCES kinds (id)');
        $this->addSql('ALTER TABLE festivals ADD CONSTRAINT FK_8F6F8878B5B48B91 FOREIGN KEY (public_id) REFERENCES publics (id)');
        $this->addSql('CREATE INDEX IDX_8F6F887830602CA9 ON festivals (kind_id)');
        $this->addSql('CREATE INDEX IDX_8F6F8878B5B48B91 ON festivals (public_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE artists_festivals');
        $this->addSql('DROP TABLE places_festivals');
        $this->addSql('ALTER TABLE festivals DROP FOREIGN KEY FK_8F6F887830602CA9');
        $this->addSql('ALTER TABLE festivals DROP FOREIGN KEY FK_8F6F8878B5B48B91');
        $this->addSql('DROP INDEX IDX_8F6F887830602CA9 ON festivals');
        $this->addSql('DROP INDEX IDX_8F6F8878B5B48B91 ON festivals');
        $this->addSql('ALTER TABLE festivals DROP kind_id, DROP public_id');
    }
}
