<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190426123603 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE blog_post_tag (blog_post_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_2E931ED7A77FBEAF (blog_post_id), INDEX IDX_2E931ED7BAD26311 (tag_id), PRIMARY KEY(blog_post_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blog_post_category (blog_post_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_CA275A0CA77FBEAF (blog_post_id), INDEX IDX_CA275A0C12469DE2 (category_id), PRIMARY KEY(blog_post_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blog_post_tag ADD CONSTRAINT FK_2E931ED7A77FBEAF FOREIGN KEY (blog_post_id) REFERENCES blog_post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE blog_post_tag ADD CONSTRAINT FK_2E931ED7BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE blog_post_category ADD CONSTRAINT FK_CA275A0CA77FBEAF FOREIGN KEY (blog_post_id) REFERENCES blog_post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE blog_post_category ADD CONSTRAINT FK_CA275A0C12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category CHANGE name title VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE tag CHANGE name title VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE blog_post DROP FOREIGN KEY FK_BA5AE01DBAD26311');
        $this->addSql('DROP INDEX FK_BA5AE01DBAD26311 ON blog_post');
        $this->addSql('ALTER TABLE blog_post DROP tag_id, DROP category_id, CHANGE author_id author_id INT DEFAULT NULL, CHANGE created_at created_at DATETIME NOT NULL');

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE blog_post_tag');
        $this->addSql('DROP TABLE blog_post_category');
        $this->addSql('ALTER TABLE blog_post ADD tag_id INT DEFAULT NULL, ADD category_id VARCHAR(255) DEFAULT \'\'\'\' NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE author_id author_id INT DEFAULT NULL, CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE blog_post ADD CONSTRAINT FK_BA5AE01DBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id)');
        $this->addSql('CREATE INDEX FK_BA5AE01DBAD26311 ON blog_post (tag_id)');
        $this->addSql('ALTER TABLE category CHANGE title name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE tag CHANGE title name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');

    }
}
