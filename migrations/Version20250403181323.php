<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250403181323 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add Admin user';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            INSERT INTO "user" (id, username, email, roles, password, created, modified) VALUES (nextval('user_id_seq'), 
            'admin', 'adriangonzalezmeda@gmail.com', '["ROLE_ADMIN"]', 
            '$2y$13$MlHsQckxUmz1ByoLet1/AOetV/L.FbiqCsko/.LST3/IvAtkT3onC', 'now()', 'now()');
        SQL);
    }

    public function down(Schema $schema): void {}
}
