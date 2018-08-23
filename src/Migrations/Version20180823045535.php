<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180823045535 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE workout_program (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, user_id INT DEFAULT NULL, title VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, media_url LONGTEXT NOT NULL, media_body VARCHAR(100) DEFAULT NULL, data JSON DEFAULT NULL, INDEX IDX_EE2B1B2C727ACA70 (parent_id), INDEX IDX_EE2B1B2CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE workout_program ADD CONSTRAINT FK_EE2B1B2C727ACA70 FOREIGN KEY (parent_id) REFERENCES workout_program (id)');
        $this->addSql('ALTER TABLE workout_program ADD CONSTRAINT FK_EE2B1B2CA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE blog_post CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE contact ADD last_name VARCHAR(255) NOT NULL, CHANGE complete_name first_name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE workout_program DROP FOREIGN KEY FK_EE2B1B2C727ACA70');
        $this->addSql('DROP TABLE workout_program');
        $this->addSql('ALTER TABLE blog_post CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE contact ADD complete_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP first_name, DROP last_name');
    }
}
