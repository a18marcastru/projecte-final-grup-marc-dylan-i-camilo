<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220522004238 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ticket_producto (id INT AUTO_INCREMENT NOT NULL, ticket_id INT NOT NULL, producto_id INT NOT NULL, cantidades INT NOT NULL, INDEX IDX_22D2FA94700047D2 (ticket_id), INDEX IDX_22D2FA947645698E (producto_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ticket_producto ADD CONSTRAINT FK_22D2FA94700047D2 FOREIGN KEY (ticket_id) REFERENCES tickets (id)');
        $this->addSql('ALTER TABLE ticket_producto ADD CONSTRAINT FK_22D2FA947645698E FOREIGN KEY (producto_id) REFERENCES productos (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ticket_producto');
    }
}
