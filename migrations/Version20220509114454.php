<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220509114454 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE historial (id INT AUTO_INCREMENT NOT NULL, material_id INT DEFAULT NULL, prestado_por_id INT NOT NULL, prestado_a_id INT NOT NULL, devuelto_por_id INT NOT NULL, fecha_hora_prestamo DATETIME NOT NULL, fecha_hora_devolucion DATETIME NOT NULL, notas VARCHAR(255) DEFAULT NULL, INDEX IDX_26950652E308AC6F (material_id), INDEX IDX_269506527FF7B85C (prestado_por_id), INDEX IDX_26950652D6801257 (prestado_a_id), INDEX IDX_26950652622069E2 (devuelto_por_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE localizacion (id INT AUTO_INCREMENT NOT NULL, padre_id INT DEFAULT NULL, codigo VARCHAR(255) NOT NULL, nombre VARCHAR(255) NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_5512F0613A909126 (nombre), INDEX IDX_5512F061613CEC58 (padre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE material (id INT AUTO_INCREMENT NOT NULL, padre_id INT DEFAULT NULL, localizacion_id INT DEFAULT NULL, persona_id INT DEFAULT NULL, prestado_por_id INT DEFAULT NULL, responsable_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, fecha_hora_ultimo_prestamo DATETIME DEFAULT NULL, fecha_hora_ultima_devolucion DATETIME DEFAULT NULL, disponible TINYINT(1) NOT NULL, fecha_alta DATETIME DEFAULT NULL, fecha_baja DATETIME DEFAULT NULL, INDEX IDX_7CBE7595613CEC58 (padre_id), INDEX IDX_7CBE7595C851F487 (localizacion_id), INDEX IDX_7CBE7595F5F88DB9 (persona_id), INDEX IDX_7CBE75957FF7B85C (prestado_por_id), INDEX IDX_7CBE759553C59D72 (responsable_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE persona (id INT AUTO_INCREMENT NOT NULL, nombre_usuario VARCHAR(255) NOT NULL, clave VARCHAR(255) NOT NULL, nombre VARCHAR(255) NOT NULL, apellidos VARCHAR(255) NOT NULL, administrador TINYINT(1) NOT NULL, gestor_prestamos TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_51E5B69BD67CF11D (nombre_usuario), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE historial ADD CONSTRAINT FK_26950652E308AC6F FOREIGN KEY (material_id) REFERENCES material (id)');
        $this->addSql('ALTER TABLE historial ADD CONSTRAINT FK_269506527FF7B85C FOREIGN KEY (prestado_por_id) REFERENCES persona (id)');
        $this->addSql('ALTER TABLE historial ADD CONSTRAINT FK_26950652D6801257 FOREIGN KEY (prestado_a_id) REFERENCES persona (id)');
        $this->addSql('ALTER TABLE historial ADD CONSTRAINT FK_26950652622069E2 FOREIGN KEY (devuelto_por_id) REFERENCES persona (id)');
        $this->addSql('ALTER TABLE localizacion ADD CONSTRAINT FK_5512F061613CEC58 FOREIGN KEY (padre_id) REFERENCES localizacion (id)');
        $this->addSql('ALTER TABLE material ADD CONSTRAINT FK_7CBE7595613CEC58 FOREIGN KEY (padre_id) REFERENCES material (id)');
        $this->addSql('ALTER TABLE material ADD CONSTRAINT FK_7CBE7595C851F487 FOREIGN KEY (localizacion_id) REFERENCES localizacion (id)');
        $this->addSql('ALTER TABLE material ADD CONSTRAINT FK_7CBE7595F5F88DB9 FOREIGN KEY (persona_id) REFERENCES persona (id)');
        $this->addSql('ALTER TABLE material ADD CONSTRAINT FK_7CBE75957FF7B85C FOREIGN KEY (prestado_por_id) REFERENCES persona (id)');
        $this->addSql('ALTER TABLE material ADD CONSTRAINT FK_7CBE759553C59D72 FOREIGN KEY (responsable_id) REFERENCES persona (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE localizacion DROP FOREIGN KEY FK_5512F061613CEC58');
        $this->addSql('ALTER TABLE material DROP FOREIGN KEY FK_7CBE7595C851F487');
        $this->addSql('ALTER TABLE historial DROP FOREIGN KEY FK_26950652E308AC6F');
        $this->addSql('ALTER TABLE material DROP FOREIGN KEY FK_7CBE7595613CEC58');
        $this->addSql('ALTER TABLE historial DROP FOREIGN KEY FK_269506527FF7B85C');
        $this->addSql('ALTER TABLE historial DROP FOREIGN KEY FK_26950652D6801257');
        $this->addSql('ALTER TABLE historial DROP FOREIGN KEY FK_26950652622069E2');
        $this->addSql('ALTER TABLE material DROP FOREIGN KEY FK_7CBE7595F5F88DB9');
        $this->addSql('ALTER TABLE material DROP FOREIGN KEY FK_7CBE75957FF7B85C');
        $this->addSql('ALTER TABLE material DROP FOREIGN KEY FK_7CBE759553C59D72');
        $this->addSql('DROP TABLE historial');
        $this->addSql('DROP TABLE localizacion');
        $this->addSql('DROP TABLE material');
        $this->addSql('DROP TABLE persona');
    }
}
