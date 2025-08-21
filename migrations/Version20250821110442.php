<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250821110442 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX idx_requests_status ON access_requests');
        $this->addSql('DROP INDEX idx_requests_user ON access_requests');
        $this->addSql('DROP INDEX idx_requests_date ON access_requests');
        $this->addSql('ALTER TABLE categories CHANGE color_hex color_hex VARCHAR(7) DEFAULT NULL, CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('DROP INDEX idx_cost_month_tool ON cost_tracking');
        $this->addSql('ALTER TABLE cost_tracking CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE total_month_ly_cost total_monthly_cost NUMERIC(10, 2) NOT NULL');
        $this->addSql('DROP INDEX idx_tools_active_users ON tools');
        $this->addSql('DROP INDEX idx_tools_department ON tools');
        $this->addSql('DROP INDEX idx_tools_cost_desc ON tools');
        $this->addSql('DROP INDEX idx_tools_status ON tools');
        $this->addSql('DROP INDEX idx_tools_category ON tools');
        $this->addSql('DROP INDEX idx_usage_date_tool ON usage_logs');
        $this->addSql('DROP INDEX idx_usage_user_date ON usage_logs');
        $this->addSql('DROP INDEX idx_access_user ON user_tool_access');
        $this->addSql('DROP INDEX idx_access_tool ON user_tool_access');
        $this->addSql('DROP INDEX idx_access_granted_date ON user_tool_access');
        $this->addSql('DROP INDEX idx_access_status ON user_tool_access');
        $this->addSql('DROP INDEX idx_users_status ON users');
        $this->addSql('DROP INDEX idx_users_department ON users');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE INDEX idx_requests_status ON access_requests (status)');
        $this->addSql('CREATE INDEX idx_requests_user ON access_requests (user_id)');
        $this->addSql('CREATE INDEX idx_requests_date ON access_requests (requested_at)');
        $this->addSql('ALTER TABLE categories CHANGE color_hex color_hex VARCHAR(7) DEFAULT \'#6366f1\', CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE cost_tracking CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE total_monthly_cost total_month_ly_cost NUMERIC(10, 2) NOT NULL');
        $this->addSql('CREATE INDEX idx_cost_month_tool ON cost_tracking (month_year, tool_id)');
        $this->addSql('CREATE INDEX idx_tools_active_users ON tools (active_users_count)');
        $this->addSql('CREATE INDEX idx_tools_department ON tools (owner_department)');
        $this->addSql('CREATE INDEX idx_tools_cost_desc ON tools (monthly_cost)');
        $this->addSql('CREATE INDEX idx_tools_status ON tools (status)');
        $this->addSql('CREATE INDEX idx_tools_category ON tools (category_id)');
        $this->addSql('CREATE INDEX idx_usage_date_tool ON usage_logs (session_date, tool_id)');
        $this->addSql('CREATE INDEX idx_usage_user_date ON usage_logs (user_id, session_date)');
        $this->addSql('CREATE INDEX idx_users_status ON users (status)');
        $this->addSql('CREATE INDEX idx_users_department ON users (department)');
        $this->addSql('CREATE INDEX idx_access_user ON user_tool_access (user_id)');
        $this->addSql('CREATE INDEX idx_access_tool ON user_tool_access (tool_id)');
        $this->addSql('CREATE INDEX idx_access_granted_date ON user_tool_access (granted_at)');
        $this->addSql('CREATE INDEX idx_access_status ON user_tool_access (status)');
    }
}
