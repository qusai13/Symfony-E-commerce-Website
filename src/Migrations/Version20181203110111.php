<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181203110111 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category CHANGE create_at create_at DATETIME NOT NULL, CHANGE update_at update_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE users CHANGE createat createat VARCHAR(255) DEFAULT NULL, CHANGE updateat updateat VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category CHANGE create_at create_at DATETIME DEFAULT \'CURRENT_TIMESTAMP(6)\' NOT NULL, CHANGE update_at update_at DATETIME DEFAULT \'CURRENT_TIMESTAMP(6)\'');
        $this->addSql('ALTER TABLE users CHANGE createat createat DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE updateat updateat DATETIME DEFAULT NULL');
    }
}
