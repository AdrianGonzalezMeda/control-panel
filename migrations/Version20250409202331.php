<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250409202331 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create slug field to set routes for blog entities';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE category ADD slug VARCHAR(150) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_64C19C1989D9B62 ON category (slug)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE post ADD slug VARCHAR(150) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_5A8A6C8D989D9B62 ON post (slug)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_5A8A6C8D989D9B62
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE post DROP slug
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_64C19C1989D9B62
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE category DROP slug
        SQL);
    }
}
