<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200501013406 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE knowledgesheet_context (knowledgesheet_id INT NOT NULL, context_id INT NOT NULL, PRIMARY KEY(knowledgesheet_id, context_id))');
        $this->addSql('CREATE INDEX IDX_9A53F358801DC957 ON knowledgesheet_context (knowledgesheet_id)');
        $this->addSql('CREATE INDEX IDX_9A53F3586B00C1CF ON knowledgesheet_context (context_id)');
        $this->addSql('ALTER TABLE knowledgesheet_context ADD CONSTRAINT FK_9A53F358801DC957 FOREIGN KEY (knowledgesheet_id) REFERENCES knowledgesheet (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE knowledgesheet_context ADD CONSTRAINT FK_9A53F3586B00C1CF FOREIGN KEY (context_id) REFERENCES context (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users_context ADD PRIMARY KEY (users_id, context_id)');
        $this->addSql('ALTER INDEX idx_4594c99767b3b43d RENAME TO IDX_125DF1B467B3B43D');
        $this->addSql('ALTER INDEX idx_4594c9976b00c1cf RENAME TO IDX_125DF1B46B00C1CF');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE knowledgesheet_context');
        $this->addSql('DROP INDEX users_context_pkey');
        $this->addSql('ALTER TABLE users_context ADD PRIMARY KEY (context_id, users_id)');
        $this->addSql('ALTER INDEX idx_125df1b467b3b43d RENAME TO idx_4594c99767b3b43d');
        $this->addSql('ALTER INDEX idx_125df1b46b00c1cf RENAME TO idx_4594c9976b00c1cf');
    }
}
