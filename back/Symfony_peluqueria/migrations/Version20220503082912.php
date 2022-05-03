<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220503082912 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE compra (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, precio INT NOT NULL, INDEX IDX_9EC131FFDB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compra_productos (compra_id INT NOT NULL, productos_id INT NOT NULL, INDEX IDX_EA1E78B6F2E704D7 (compra_id), INDEX IDX_EA1E78B6ED07566B (productos_id), PRIMARY KEY(compra_id, productos_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comprar (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE compra ADD CONSTRAINT FK_9EC131FFDB38439E FOREIGN KEY (usuario_id) REFERENCES usuarios (id)');
        $this->addSql('ALTER TABLE compra_productos ADD CONSTRAINT FK_EA1E78B6F2E704D7 FOREIGN KEY (compra_id) REFERENCES compra (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE compra_productos ADD CONSTRAINT FK_EA1E78B6ED07566B FOREIGN KEY (productos_id) REFERENCES productos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE usuarios DROP foto');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compra_productos DROP FOREIGN KEY FK_EA1E78B6F2E704D7');
        $this->addSql('DROP TABLE compra');
        $this->addSql('DROP TABLE compra_productos');
        $this->addSql('DROP TABLE comprar');
        $this->addSql('ALTER TABLE usuarios ADD foto LONGBLOB NOT NULL');
    }
}
