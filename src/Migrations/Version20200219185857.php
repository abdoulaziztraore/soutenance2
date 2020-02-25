<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200219185857 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE note (id INT AUTO_INCREMENT NOT NULL, note INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, creneaux_id INT DEFAULT NULL, create_at DATETIME NOT NULL, module VARCHAR(255) NOT NULL, rendu_type VARCHAR(255) NOT NULL, nombre_etudiant INT NOT NULL, INDEX IDX_D044D5D49F072641 (creneaux_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE creneau_horaire (id INT AUTO_INCREMENT NOT NULL, heure DATETIME NOT NULL, devoir VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, notes_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, mention VARCHAR(255) NOT NULL, INDEX IDX_C242628FC56F556 (notes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D49F072641 FOREIGN KEY (creneaux_id) REFERENCES creneau_horaire (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C242628FC56F556 FOREIGN KEY (notes_id) REFERENCES note (id)');
        $this->addSql('ALTER TABLE user ADD notes_id INT DEFAULT NULL, ADD sessions_id INT DEFAULT NULL, ADD profile VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649FC56F556 FOREIGN KEY (notes_id) REFERENCES note (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F17C4D8C FOREIGN KEY (sessions_id) REFERENCES session (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649FC56F556 ON user (notes_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649F17C4D8C ON user (sessions_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649FC56F556');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C242628FC56F556');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F17C4D8C');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D49F072641');
        $this->addSql('DROP TABLE note');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE creneau_horaire');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP INDEX IDX_8D93D649FC56F556 ON user');
        $this->addSql('DROP INDEX IDX_8D93D649F17C4D8C ON user');
        $this->addSql('ALTER TABLE user DROP notes_id, DROP sessions_id, DROP profile');
    }
}
