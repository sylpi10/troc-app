<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220901122232 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE trade (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trade_user (trade_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_EF68A1B2C2D9760 (trade_id), INDEX IDX_EF68A1B2A76ED395 (user_id), PRIMARY KEY(trade_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trade_object_to_sell (trade_id INT NOT NULL, object_to_sell_id INT NOT NULL, INDEX IDX_BE78CDB0C2D9760 (trade_id), INDEX IDX_BE78CDB051E0D1BD (object_to_sell_id), PRIMARY KEY(trade_id, object_to_sell_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE trade_user ADD CONSTRAINT FK_EF68A1B2C2D9760 FOREIGN KEY (trade_id) REFERENCES trade (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trade_user ADD CONSTRAINT FK_EF68A1B2A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trade_object_to_sell ADD CONSTRAINT FK_BE78CDB0C2D9760 FOREIGN KEY (trade_id) REFERENCES trade (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trade_object_to_sell ADD CONSTRAINT FK_BE78CDB051E0D1BD FOREIGN KEY (object_to_sell_id) REFERENCES object_to_sell (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE trade_user DROP FOREIGN KEY FK_EF68A1B2C2D9760');
        $this->addSql('ALTER TABLE trade_user DROP FOREIGN KEY FK_EF68A1B2A76ED395');
        $this->addSql('ALTER TABLE trade_object_to_sell DROP FOREIGN KEY FK_BE78CDB0C2D9760');
        $this->addSql('ALTER TABLE trade_object_to_sell DROP FOREIGN KEY FK_BE78CDB051E0D1BD');
        $this->addSql('DROP TABLE trade');
        $this->addSql('DROP TABLE trade_user');
        $this->addSql('DROP TABLE trade_object_to_sell');
    }
}
