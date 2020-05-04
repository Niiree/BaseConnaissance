<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200504142801 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE users ADD password_requested_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX users_context_pkey');
        $this->addSql('ALTER TABLE users_context ADD PRIMARY KEY (context_id, users_id)');
        $this->addSql('ALTER INDEX idx_125df1b467b3b43d RENAME TO idx_4594c99767b3b43d');
        $this->addSql('ALTER INDEX idx_125df1b46b00c1cf RENAME TO idx_4594c9976b00c1cf');
        $this->addSql('ALTER TABLE users DROP password_requested_at');
    }
}
