<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220511104232 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reserva_servicio (id INT AUTO_INCREMENT NOT NULL, servicio_id INT NOT NULL, reserva_id INT NOT NULL, INDEX IDX_A39A92E571CAA3E7 (servicio_id), INDEX IDX_A39A92E5D67139E8 (reserva_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservas (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, fecha DATE NOT NULL, hora TIME NOT NULL, telefono INT NOT NULL, INDEX IDX_AA1DAB01DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE servicios (id INT AUTO_INCREMENT NOT NULL, nombre_servicio VARCHAR(255) NOT NULL, precio INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reserva_servicio ADD CONSTRAINT FK_A39A92E571CAA3E7 FOREIGN KEY (servicio_id) REFERENCES servicios (id)');
        $this->addSql('ALTER TABLE reserva_servicio ADD CONSTRAINT FK_A39A92E5D67139E8 FOREIGN KEY (reserva_id) REFERENCES reservas (id)');
        $this->addSql('ALTER TABLE reservas ADD CONSTRAINT FK_AA1DAB01DB38439E FOREIGN KEY (usuario_id) REFERENCES usuarios (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reserva_servicio DROP FOREIGN KEY FK_A39A92E5D67139E8');
        $this->addSql('ALTER TABLE reserva_servicio DROP FOREIGN KEY FK_A39A92E571CAA3E7');
        $this->addSql('DROP TABLE reserva_servicio');
        $this->addSql('DROP TABLE reservas');
        $this->addSql('DROP TABLE servicios');
    }
}
