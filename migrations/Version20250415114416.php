<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250415114416 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Created and modified by user to log post creations';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE post ADD created_by_user_id INT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE post ADD modified_by_user_id INT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D7D182D95 FOREIGN KEY (created_by_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DDD5BE62E FOREIGN KEY (modified_by_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_5A8A6C8D7D182D95 ON post (created_by_user_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_5A8A6C8DDD5BE62E ON post (modified_by_user_id)
        SQL);
        $this->addSql(<<<'SQL'
            UPDATE "post" SET created_by_user_id = '16', modified_by_user_id = '16';
        SQL);
            $this->addSql(<<<'SQL'
        ALTER TABLE "post" ALTER COLUMN created_by_user_id SET NOT NULL
        SQL);
            $this->addSql(<<<'SQL'
        ALTER TABLE "post" ALTER COLUMN modified_by_user_id SET NOT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE post DROP CONSTRAINT FK_5A8A6C8D7D182D95
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE post DROP CONSTRAINT FK_5A8A6C8DDD5BE62E
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_5A8A6C8D7D182D95
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_5A8A6C8DDD5BE62E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE post DROP created_by_user_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE post DROP modified_by_user_id
        SQL);
    }
}
