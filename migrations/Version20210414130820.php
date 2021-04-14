<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210414130820 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_quantite (id INT AUTO_INCREMENT NOT NULL, commande_id INT DEFAULT NULL, quantite INT NOT NULL, INDEX IDX_5DD252E382EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_quantite ADD CONSTRAINT FK_5DD252E382EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE produit ADD commande_quantite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC272DB527BA FOREIGN KEY (commande_quantite_id) REFERENCES commande_quantite (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC272DB527BA ON produit (commande_quantite_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC272DB527BA');
        $this->addSql('DROP TABLE commande_quantite');
        $this->addSql('DROP INDEX IDX_29A5EC272DB527BA ON produit');
        $this->addSql('ALTER TABLE produit DROP commande_quantite_id');
    }
}
