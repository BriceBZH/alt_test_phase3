<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250821105608 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE access_requests CHANGE processed_by processed_by INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tools CHANGE description description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_tool_access DROP FOREIGN KEY FK_CA23EEDD3151C11F');
        $this->addSql('ALTER TABLE user_tool_access DROP FOREIGN KEY FK_CA23EEDDFB8FE773');
        $this->addSql('DROP INDEX IDX_CA23EEDD3151C11F ON user_tool_access');
        $this->addSql('DROP INDEX IDX_CA23EEDDFB8FE773 ON user_tool_access');
        $this->addSql('ALTER TABLE user_tool_access CHANGE granted_by_id granted_by INT NOT NULL, CHANGE revoked_by_id revoked_by INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_tool_access ADD CONSTRAINT FK_CA23EEDDA5FB753F FOREIGN KEY (granted_by) REFERENCES users (id)');
        $this->addSql('ALTER TABLE user_tool_access ADD CONSTRAINT FK_CA23EEDD8E5493E3 FOREIGN KEY (revoked_by) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_CA23EEDDA5FB753F ON user_tool_access (granted_by)');
        $this->addSql('CREATE INDEX IDX_CA23EEDD8E5493E3 ON user_tool_access (revoked_by)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE access_requests CHANGE processed_by processed_by INT NOT NULL');
        $this->addSql('ALTER TABLE tools CHANGE description description LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE user_tool_access DROP FOREIGN KEY FK_CA23EEDDA5FB753F');
        $this->addSql('ALTER TABLE user_tool_access DROP FOREIGN KEY FK_CA23EEDD8E5493E3');
        $this->addSql('DROP INDEX IDX_CA23EEDDA5FB753F ON user_tool_access');
        $this->addSql('DROP INDEX IDX_CA23EEDD8E5493E3 ON user_tool_access');
        $this->addSql('ALTER TABLE user_tool_access CHANGE granted_by granted_by_id INT NOT NULL, CHANGE revoked_by revoked_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_tool_access ADD CONSTRAINT FK_CA23EEDD3151C11F FOREIGN KEY (granted_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE user_tool_access ADD CONSTRAINT FK_CA23EEDDFB8FE773 FOREIGN KEY (revoked_by_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_CA23EEDD3151C11F ON user_tool_access (granted_by_id)');
        $this->addSql('CREATE INDEX IDX_CA23EEDDFB8FE773 ON user_tool_access (revoked_by_id)');
    }
}
