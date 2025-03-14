<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250313125429 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE favorite (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, product_id INT DEFAULT NULL, INDEX IDX_68C58ED9A76ED395 (user_id), INDEX IDX_68C58ED94584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE favorite ADD CONSTRAINT FK_68C58ED9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE favorite ADD CONSTRAINT FK_68C58ED94584665A FOREIGN KEY (product_id) REFERENCES product_sell (id)');
        $this->addSql('ALTER TABLE user_product_sell DROP FOREIGN KEY FK_96BA8EDE7D3E5E44');
        $this->addSql('ALTER TABLE user_product_sell DROP FOREIGN KEY FK_96BA8EDEA76ED395');
        $this->addSql('DROP TABLE user_product_sell');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_product_sell (user_id INT NOT NULL, product_sell_id INT NOT NULL, INDEX IDX_96BA8EDE7D3E5E44 (product_sell_id), INDEX IDX_96BA8EDEA76ED395 (user_id), PRIMARY KEY(user_id, product_sell_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_product_sell ADD CONSTRAINT FK_96BA8EDE7D3E5E44 FOREIGN KEY (product_sell_id) REFERENCES product_sell (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_product_sell ADD CONSTRAINT FK_96BA8EDEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favorite DROP FOREIGN KEY FK_68C58ED9A76ED395');
        $this->addSql('ALTER TABLE favorite DROP FOREIGN KEY FK_68C58ED94584665A');
        $this->addSql('DROP TABLE favorite');
    }
}
