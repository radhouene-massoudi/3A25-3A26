<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230228100350 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compture ADD dep_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE compture ADD CONSTRAINT FK_9DB6ABA5814AA86C FOREIGN KEY (dep_id) REFERENCES departement (ref)');
        $this->addSql('CREATE INDEX IDX_9DB6ABA5814AA86C ON compture (dep_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compture DROP FOREIGN KEY FK_9DB6ABA5814AA86C');
        $this->addSql('DROP INDEX IDX_9DB6ABA5814AA86C ON compture');
        $this->addSql('ALTER TABLE compture DROP dep_id');
    }
}
