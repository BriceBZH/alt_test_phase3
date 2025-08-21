<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250821105033 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE access_requests DROP FOREIGN KEY FK_169017602FFD4FD3');
        $this->addSql('DROP INDEX IDX_169017602FFD4FD3 ON access_requests');
        $this->addSql('ALTER TABLE access_requests CHANGE processed_by_id processed_by INT NOT NULL');
        $this->addSql('ALTER TABLE access_requests ADD CONSTRAINT FK_16901760888A646A FOREIGN KEY (processed_by) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_16901760888A646A ON access_requests (processed_by)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE access_requests DROP FOREIGN KEY FK_16901760888A646A');
        $this->addSql('DROP INDEX IDX_16901760888A646A ON access_requests');
        $this->addSql('ALTER TABLE access_requests CHANGE processed_by processed_by_id INT NOT NULL');
        $this->addSql('ALTER TABLE access_requests ADD CONSTRAINT FK_169017602FFD4FD3 FOREIGN KEY (processed_by_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_169017602FFD4FD3 ON access_requests (processed_by_id)');
    }
}
