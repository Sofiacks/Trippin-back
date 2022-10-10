<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221010125322 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD contenu LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE trip DROP FOREIGN KEY FK_7656F53BBCF5E72D');
        $this->addSql('DROP INDEX IDX_7656F53BBCF5E72D ON trip');
        $this->addSql('ALTER TABLE trip DROP categorie_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP contenu');
        $this->addSql('ALTER TABLE trip ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53BBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_7656F53BBCF5E72D ON trip (categorie_id)');
    }
}
