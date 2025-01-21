<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250121155724 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP user_id, DROP id_produit');
        $this->addSql('ALTER TABLE product_buy ADD user_id INT NOT NULL, ADD command_id INT NOT NULL');
        $this->addSql('ALTER TABLE product_buy ADD CONSTRAINT FK_2FACD668A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE product_buy ADD CONSTRAINT FK_2FACD66833E1689A FOREIGN KEY (command_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_2FACD668A76ED395 ON product_buy (user_id)');
        $this->addSql('CREATE INDEX IDX_2FACD66833E1689A ON product_buy (command_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD user_id INT NOT NULL, ADD id_produit DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE product_buy DROP FOREIGN KEY FK_2FACD668A76ED395');
        $this->addSql('ALTER TABLE product_buy DROP FOREIGN KEY FK_2FACD66833E1689A');
        $this->addSql('DROP INDEX IDX_2FACD668A76ED395 ON product_buy');
        $this->addSql('DROP INDEX IDX_2FACD66833E1689A ON product_buy');
        $this->addSql('ALTER TABLE product_buy DROP user_id, DROP command_id');
    }
}
