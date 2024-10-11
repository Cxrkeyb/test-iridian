<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241011095036 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE area_contacto (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE cobertura (id INT AUTO_INCREMENT NOT NULL, area LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE mensaje_contacto (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, apellido VARCHAR(255) NOT NULL, correo VARCHAR(255) NOT NULL, celular VARCHAR(255) NOT NULL, mensaje LONGTEXT NOT NULL, created_at DATETIME NOT NULL, area_contacto_id INT NOT NULL, INDEX IDX_34BB8C1D406BF6D9 (area_contacto_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE mensaje_contacto ADD CONSTRAINT FK_34BB8C1D406BF6D9 FOREIGN KEY (area_contacto_id) REFERENCES area_contacto (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mensaje_contacto DROP FOREIGN KEY FK_34BB8C1D406BF6D9');
        $this->addSql('DROP TABLE area_contacto');
        $this->addSql('DROP TABLE cobertura');
        $this->addSql('DROP TABLE mensaje_contacto');
    }
}
