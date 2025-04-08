<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250408135900 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Adding indexes to User email and username fields';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
        CREATE  INDEX idx_user_email ON "user" USING btree ("email");
        SQL);
        $this->addSql(<<<'SQL'
        CREATE  INDEX idx_user_username ON "user" USING btree ("username");
        SQL);
    }

    public function down(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            DROP INDEX idx_user_email;
        SQL);
        
        $this->addSql(<<<'SQL'
            DROP INDEX idx_user_username;
        SQL);
    }
}
