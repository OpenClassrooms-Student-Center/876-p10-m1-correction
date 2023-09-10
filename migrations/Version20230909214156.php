<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230909214156 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_938720751B65292');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_938720751B65292 FOREIGN KEY (employe_id) REFERENCES employe (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_938720751B65292');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_938720751B65292 FOREIGN KEY (employe_id) REFERENCES employe (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
