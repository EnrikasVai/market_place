<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250207075444 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__listing AS SELECT id, category_id, title, description, price, created_at, thumbnail FROM listing');
        $this->addSql('DROP TABLE listing');
        $this->addSql('CREATE TABLE listing (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, category_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, description CLOB NOT NULL, price NUMERIC(10, 0) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , thumbnail VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_CB0048D412469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO listing (id, category_id, title, description, price, created_at, thumbnail) SELECT id, category_id, title, description, price, created_at, thumbnail FROM __temp__listing');
        $this->addSql('DROP TABLE __temp__listing');
        $this->addSql('CREATE INDEX IDX_CB0048D412469DE2 ON listing (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__listing AS SELECT id, category_id, title, description, price, thumbnail, created_at FROM listing');
        $this->addSql('DROP TABLE listing');
        $this->addSql('CREATE TABLE listing (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, category_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, description CLOB NOT NULL, price NUMERIC(10, 0) NOT NULL, thumbnail VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_CB0048D412469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO listing (id, category_id, title, description, price, thumbnail, created_at) SELECT id, category_id, title, description, price, thumbnail, created_at FROM __temp__listing');
        $this->addSql('DROP TABLE __temp__listing');
        $this->addSql('CREATE INDEX IDX_CB0048D412469DE2 ON listing (category_id)');
    }
}
