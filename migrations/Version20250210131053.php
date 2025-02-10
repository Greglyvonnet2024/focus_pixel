<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250210131053 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_sell CHANGE command_id command_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product_sell ADD CONSTRAINT FK_1676F2DC33E1689A FOREIGN KEY (command_id) REFERENCES orders (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_sell DROP FOREIGN KEY FK_1676F2DC33E1689A');
        $this->addSql('ALTER TABLE product_sell CHANGE command_id command_id INT NOT NULL');
    }
}
