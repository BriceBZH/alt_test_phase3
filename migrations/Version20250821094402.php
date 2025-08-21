<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250821094402 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE access_requests (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, tool_id INT NOT NULL, processed_by_id INT NOT NULL, business_justification LONGTEXT NOT NULL, status VARCHAR(255) DEFAULT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', processed_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', processing_notes LONGTEXT DEFAULT NULL, INDEX IDX_16901760A76ED395 (user_id), INDEX IDX_169017608F7B22CC (tool_id), INDEX IDX_169017602FFD4FD3 (processed_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, description LONGTEXT DEFAULT NULL, color_hex VARCHAR(7) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tools (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, vendor VARCHAR(100) DEFAULT NULL, website_url VARCHAR(255) DEFAULT NULL, monthly_cost NUMERIC(10, 2) NOT NULL, active_users_count INT NOT NULL, owner_department VARCHAR(255) NOT NULL, status VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_EAFADE7712469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, email VARCHAR(150) NOT NULL, department VARCHAR(255) NOT NULL, role VARCHAR(255) DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, hire_date DATE DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE access_requests ADD CONSTRAINT FK_16901760A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE access_requests ADD CONSTRAINT FK_169017608F7B22CC FOREIGN KEY (tool_id) REFERENCES tools (id)');
        $this->addSql('ALTER TABLE access_requests ADD CONSTRAINT FK_169017602FFD4FD3 FOREIGN KEY (processed_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE tools ADD CONSTRAINT FK_EAFADE7712469DE2 FOREIGN KEY (category_id) REFERENCES categories (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE access_requests DROP FOREIGN KEY FK_16901760A76ED395');
        $this->addSql('ALTER TABLE access_requests DROP FOREIGN KEY FK_169017608F7B22CC');
        $this->addSql('ALTER TABLE access_requests DROP FOREIGN KEY FK_169017602FFD4FD3');
        $this->addSql('ALTER TABLE tools DROP FOREIGN KEY FK_EAFADE7712469DE2');
        $this->addSql('DROP TABLE access_requests');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE tools');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
