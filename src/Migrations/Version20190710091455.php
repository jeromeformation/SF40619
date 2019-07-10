<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190710091455 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE lien (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, ki SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnage (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnage_lien (personnage_id INT NOT NULL, lien_id INT NOT NULL, INDEX IDX_FC72D1DB5E315342 (personnage_id), INDEX IDX_FC72D1DBEDAAC352 (lien_id), PRIMARY KEY(personnage_id, lien_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE personnage_lien ADD CONSTRAINT FK_FC72D1DB5E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personnage_lien ADD CONSTRAINT FK_FC72D1DBEDAAC352 FOREIGN KEY (lien_id) REFERENCES lien (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE personnage_lien DROP FOREIGN KEY FK_FC72D1DBEDAAC352');
        $this->addSql('ALTER TABLE personnage_lien DROP FOREIGN KEY FK_FC72D1DB5E315342');
        $this->addSql('DROP TABLE lien');
        $this->addSql('DROP TABLE personnage');
        $this->addSql('DROP TABLE personnage_lien');
    }
}
