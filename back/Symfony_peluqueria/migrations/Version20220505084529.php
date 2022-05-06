<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220505084529 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tiquets (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, fecha DATETIME NOT NULL, precio_total INT NOT NULL, INDEX IDX_FEA079BADB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tiquets_productos (tiquets_id INT NOT NULL, productos_id INT NOT NULL, INDEX IDX_6030F98D86A3DF5F (tiquets_id), INDEX IDX_6030F98DED07566B (productos_id), PRIMARY KEY(tiquets_id, productos_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tiquets ADD CONSTRAINT FK_FEA079BADB38439E FOREIGN KEY (usuario_id) REFERENCES usuarios (id)');
        $this->addSql('ALTER TABLE tiquets_productos ADD CONSTRAINT FK_6030F98D86A3DF5F FOREIGN KEY (tiquets_id) REFERENCES tiquets (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tiquets_productos ADD CONSTRAINT FK_6030F98DED07566B FOREIGN KEY (productos_id) REFERENCES productos (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tiquets_productos DROP FOREIGN KEY FK_6030F98D86A3DF5F');
        $this->addSql('DROP TABLE tiquets');
        $this->addSql('DROP TABLE tiquets_productos');
    }
}
