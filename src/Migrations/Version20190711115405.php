<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190711115405 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_user ADD client_id INT DEFAULT NULL, ADD magasin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE app_user ADD CONSTRAINT FK_88BDF3E919EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE app_user ADD CONSTRAINT FK_88BDF3E920096AE3 FOREIGN KEY (magasin_id) REFERENCES magasin (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_88BDF3E919EB6921 ON app_user (client_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_88BDF3E920096AE3 ON app_user (magasin_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_user DROP FOREIGN KEY FK_88BDF3E919EB6921');
        $this->addSql('ALTER TABLE app_user DROP FOREIGN KEY FK_88BDF3E920096AE3');
        $this->addSql('DROP INDEX UNIQ_88BDF3E919EB6921 ON app_user');
        $this->addSql('DROP INDEX UNIQ_88BDF3E920096AE3 ON app_user');
        $this->addSql('ALTER TABLE app_user DROP client_id, DROP magasin_id');
    }
}
