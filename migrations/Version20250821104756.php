<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250821104756 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cost_tracking (id INT AUTO_INCREMENT NOT NULL, tool_id INT NOT NULL, month_year DATE NOT NULL, total_month_ly_cost NUMERIC(10, 2) NOT NULL, active_users_count INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_1E5C21A98F7B22CC (tool_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usage_logs (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, tool_id INT NOT NULL, session_date DATE NOT NULL, usage_minutes INT DEFAULT NULL, actions_count INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_5B25D447A76ED395 (user_id), INDEX IDX_5B25D4478F7B22CC (tool_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_tool_access (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, tool_id INT NOT NULL, granted_by_id INT NOT NULL, revoked_by_id INT DEFAULT NULL, granted_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', revoked_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', status VARCHAR(255) DEFAULT NULL, INDEX IDX_CA23EEDDA76ED395 (user_id), INDEX IDX_CA23EEDD8F7B22CC (tool_id), INDEX IDX_CA23EEDD3151C11F (granted_by_id), INDEX IDX_CA23EEDDFB8FE773 (revoked_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cost_tracking ADD CONSTRAINT FK_1E5C21A98F7B22CC FOREIGN KEY (tool_id) REFERENCES tools (id)');
        $this->addSql('ALTER TABLE usage_logs ADD CONSTRAINT FK_5B25D447A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE usage_logs ADD CONSTRAINT FK_5B25D4478F7B22CC FOREIGN KEY (tool_id) REFERENCES tools (id)');
        $this->addSql('ALTER TABLE user_tool_access ADD CONSTRAINT FK_CA23EEDDA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE user_tool_access ADD CONSTRAINT FK_CA23EEDD8F7B22CC FOREIGN KEY (tool_id) REFERENCES tools (id)');
        $this->addSql('ALTER TABLE user_tool_access ADD CONSTRAINT FK_CA23EEDD3151C11F FOREIGN KEY (granted_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE user_tool_access ADD CONSTRAINT FK_CA23EEDDFB8FE773 FOREIGN KEY (revoked_by_id) REFERENCES users (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cost_tracking DROP FOREIGN KEY FK_1E5C21A98F7B22CC');
        $this->addSql('ALTER TABLE usage_logs DROP FOREIGN KEY FK_5B25D447A76ED395');
        $this->addSql('ALTER TABLE usage_logs DROP FOREIGN KEY FK_5B25D4478F7B22CC');
        $this->addSql('ALTER TABLE user_tool_access DROP FOREIGN KEY FK_CA23EEDDA76ED395');
        $this->addSql('ALTER TABLE user_tool_access DROP FOREIGN KEY FK_CA23EEDD8F7B22CC');
        $this->addSql('ALTER TABLE user_tool_access DROP FOREIGN KEY FK_CA23EEDD3151C11F');
        $this->addSql('ALTER TABLE user_tool_access DROP FOREIGN KEY FK_CA23EEDDFB8FE773');
        $this->addSql('DROP TABLE cost_tracking');
        $this->addSql('DROP TABLE usage_logs');
        $this->addSql('DROP TABLE user_tool_access');
    }
}
