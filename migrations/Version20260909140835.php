<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260909140835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add details to quote requests.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE quote_request ADD article_type VARCHAR(255) DEFAULT NULL, ADD article_origin VARCHAR(255) DEFAULT NULL, ADD marking_type VARCHAR(255) DEFAULT NULL, ADD logo VARCHAR(255) DEFAULT NULL, ADD quantity INT DEFAULT NULL, ADD organization_type VARCHAR(255) DEFAULT NULL, ADD organization_name VARCHAR(255) DEFAULT NULL, ADD phone VARCHAR(50) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE quote_request DROP article_type, DROP article_origin, DROP marking_type, DROP logo, DROP quantity, DROP organization_type, DROP organization_name, DROP phone');
    }
}
