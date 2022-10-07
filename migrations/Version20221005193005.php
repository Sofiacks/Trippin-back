<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221005193005 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trip (id INT AUTO_INCREMENT NOT NULL, ville VARCHAR(50) NOT NULL, date_depart DATE NOT NULL, date_retour DATE NOT NULL, description VARCHAR(255) NOT NULL, nb_participants INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trip_categorie (trip_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_54629763A5BC2E0E (trip_id), INDEX IDX_54629763BCF5E72D (categorie_id), PRIMARY KEY(trip_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trip_tag (trip_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_8F404E39A5BC2E0E (trip_id), INDEX IDX_8F404E39BAD26311 (tag_id), PRIMARY KEY(trip_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE trip_categorie ADD CONSTRAINT FK_54629763A5BC2E0E FOREIGN KEY (trip_id) REFERENCES trip (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trip_categorie ADD CONSTRAINT FK_54629763BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trip_tag ADD CONSTRAINT FK_8F404E39A5BC2E0E FOREIGN KEY (trip_id) REFERENCES trip (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trip_tag ADD CONSTRAINT FK_8F404E39BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE trip_categorie DROP FOREIGN KEY FK_54629763A5BC2E0E');
        $this->addSql('ALTER TABLE trip_categorie DROP FOREIGN KEY FK_54629763BCF5E72D');
        $this->addSql('ALTER TABLE trip_tag DROP FOREIGN KEY FK_8F404E39A5BC2E0E');
        $this->addSql('ALTER TABLE trip_tag DROP FOREIGN KEY FK_8F404E39BAD26311');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE trip');
        $this->addSql('DROP TABLE trip_categorie');
        $this->addSql('DROP TABLE trip_tag');
    }
}
