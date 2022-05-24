<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220524100310 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comentarios (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, descripcion VARCHAR(255) NOT NULL, valoracion INT NOT NULL, INDEX IDX_F54B3FC0DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE productos (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, descripcion VARCHAR(255) NOT NULL, cantidad INT NOT NULL, precio INT NOT NULL, imagen VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reserva_servicio (id INT AUTO_INCREMENT NOT NULL, servicio_id INT NOT NULL, reserva_id INT NOT NULL, INDEX IDX_A39A92E571CAA3E7 (servicio_id), INDEX IDX_A39A92E5D67139E8 (reserva_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservas (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, precio_total INT NOT NULL, dia VARCHAR(255) NOT NULL, hora VARCHAR(255) NOT NULL, mes VARCHAR(255) NOT NULL, INDEX IDX_AA1DAB01DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE servicios (id INT AUTO_INCREMENT NOT NULL, nombre_servicio VARCHAR(255) NOT NULL, precio INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket_producto (id INT AUTO_INCREMENT NOT NULL, ticket_id INT NOT NULL, producto_id INT NOT NULL, cantidades INT NOT NULL, INDEX IDX_22D2FA94700047D2 (ticket_id), INDEX IDX_22D2FA947645698E (producto_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tickets (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, fecha VARCHAR(255) NOT NULL, precio_total INT NOT NULL, INDEX IDX_54469DF4DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuarios (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, apellido VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, contrasena VARCHAR(255) NOT NULL, telefono INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comentarios ADD CONSTRAINT FK_F54B3FC0DB38439E FOREIGN KEY (usuario_id) REFERENCES usuarios (id)');
        $this->addSql('ALTER TABLE reserva_servicio ADD CONSTRAINT FK_A39A92E571CAA3E7 FOREIGN KEY (servicio_id) REFERENCES servicios (id)');
        $this->addSql('ALTER TABLE reserva_servicio ADD CONSTRAINT FK_A39A92E5D67139E8 FOREIGN KEY (reserva_id) REFERENCES reservas (id)');
        $this->addSql('ALTER TABLE reservas ADD CONSTRAINT FK_AA1DAB01DB38439E FOREIGN KEY (usuario_id) REFERENCES usuarios (id)');
        $this->addSql('ALTER TABLE ticket_producto ADD CONSTRAINT FK_22D2FA94700047D2 FOREIGN KEY (ticket_id) REFERENCES tickets (id)');
        $this->addSql('ALTER TABLE ticket_producto ADD CONSTRAINT FK_22D2FA947645698E FOREIGN KEY (producto_id) REFERENCES productos (id)');
        $this->addSql('ALTER TABLE tickets ADD CONSTRAINT FK_54469DF4DB38439E FOREIGN KEY (usuario_id) REFERENCES usuarios (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ticket_producto DROP FOREIGN KEY FK_22D2FA947645698E');
        $this->addSql('ALTER TABLE reserva_servicio DROP FOREIGN KEY FK_A39A92E5D67139E8');
        $this->addSql('ALTER TABLE reserva_servicio DROP FOREIGN KEY FK_A39A92E571CAA3E7');
        $this->addSql('ALTER TABLE ticket_producto DROP FOREIGN KEY FK_22D2FA94700047D2');
        $this->addSql('ALTER TABLE comentarios DROP FOREIGN KEY FK_F54B3FC0DB38439E');
        $this->addSql('ALTER TABLE reservas DROP FOREIGN KEY FK_AA1DAB01DB38439E');
        $this->addSql('ALTER TABLE tickets DROP FOREIGN KEY FK_54469DF4DB38439E');
        $this->addSql('DROP TABLE comentarios');
        $this->addSql('DROP TABLE productos');
        $this->addSql('DROP TABLE reserva_servicio');
        $this->addSql('DROP TABLE reservas');
        $this->addSql('DROP TABLE servicios');
        $this->addSql('DROP TABLE ticket_producto');
        $this->addSql('DROP TABLE tickets');
        $this->addSql('DROP TABLE usuarios');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
