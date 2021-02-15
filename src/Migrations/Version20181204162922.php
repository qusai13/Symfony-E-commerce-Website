<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181204162922 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category ADD stauts VARCHAR(10) NOT NULL, ADD createdat VARCHAR(255) DEFAULT NULL, ADD updatedat VARCHAR(255) DEFAULT NULL, DROP create_at, DROP update_at, DROP status, CHANGE description description VARCHAR(255) DEFAULT NULL, CHANGE keywords keywords VARCHAR(255) DEFAULT NULL, CHANGE parent_id parentid INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category ADD create_at VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD update_at VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD status VARCHAR(30) NOT NULL COLLATE utf8mb4_unicode_ci, DROP stauts, DROP createdat, DROP updatedat, CHANGE description description VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE keywords keywords VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE parentid parent_id INT NOT NULL');
    }
}
