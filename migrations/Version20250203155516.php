<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250203155516 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_sell ADD command_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product_sell ADD CONSTRAINT FK_1676F2DC33E1689A FOREIGN KEY (command_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_1676F2DC33E1689A ON product_sell (command_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_sell DROP FOREIGN KEY FK_1676F2DC33E1689A');
        $this->addSql('DROP INDEX IDX_1676F2DC33E1689A ON product_sell');
        $this->addSql('ALTER TABLE product_sell DROP command_id');
    }
}
