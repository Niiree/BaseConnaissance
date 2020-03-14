<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200305200214 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');
        // Peut être ça va peter..
        $this->addSql('ALTER TABLE knowledgesheet ADD fulltext TSVECTOR DEFAULT NULL');
        $this->addSql('
CREATE OR REPLACE FUNCTION messages_trigger()
 RETURNS trigger
 LANGUAGE plpgsql
AS $function$
begin
  new.fulltext :=
     setweight(to_tsvector(\'pg_catalog.french\', coalesce(new.title,\'\')), \'B\') ||
         setweight(to_tsvector(\'pg_catalog.french\', coalesce(new.content,\'\')), \'C\') ||
     setweight(to_tsvector(\'pg_catalog.french\', coalesce(new.keyword,\'\')), \'A\');
  return new;
end
$function$
');
        $this->addSql('CREATE TRIGGER tsupdatefunction BEFORE INSERT OR UPDATE  ON knowledgesheet FOR EACH ROW EXECUTE PROCEDURE messages_trigger()');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE knowledgesheet DROP fulltext');
    }
}
