<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260919182000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Normalize quote request statuses to new, processing and finished.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            UPDATE quote_request
            SET status = CASE
                WHEN status IN ('processing') THEN 'processing'
                WHEN status IN ('finished', 'processed', 'approved') THEN 'finished'
                ELSE 'new'
            END
        ");
    }

    public function down(Schema $schema): void
    {
        // The previous status values cannot be restored reliably after normalization.
    }
}
