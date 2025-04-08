<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250408143702 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Adding association fields to User Entity';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            DROP INDEX idx_user_email
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "user" ADD created_by_user_id INT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "user" ADD modified_by_user_id INT NULL
        SQL);
        $this->addSql(<<<'SQL'
            UPDATE "user" SET created_by_user_id = '2', modified_by_user_id = '2';
        SQL);
        $this->addSql(<<<'SQL'
        ALTER TABLE "user" ALTER COLUMN created_by_user_id SET NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
        ALTER TABLE "user" ALTER COLUMN modified_by_user_id SET NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "user" ADD CONSTRAINT FK_8D93D6497D182D95 FOREIGN KEY (created_by_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "user" ADD CONSTRAINT FK_8D93D6492793CC5E FOREIGN KEY (modified_by_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8D93D6497D182D95 ON "user" (created_by_user_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8D93D6492793CC5E ON "user" (modified_by_user_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "user" DROP CONSTRAINT FK_8D93D6497D182D95
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "user" DROP CONSTRAINT FK_8D93D6492793CC5E
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_8D93D6497D182D95
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_8D93D6492793CC5E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "user" DROP created_by_user_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "user" DROP modified_by_user_id
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX idx_user_email ON "user" (email)
        SQL);
    }
}
