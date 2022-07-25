<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220725134611 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE token_user_token (token_user_id INT NOT NULL, token_id INT NOT NULL, INDEX IDX_55394BDD4961CA16 (token_user_id), INDEX IDX_55394BDD41DEE7B9 (token_id), PRIMARY KEY(token_user_id, token_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE token_user_token ADD CONSTRAINT FK_55394BDD4961CA16 FOREIGN KEY (token_user_id) REFERENCES token_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE token_user_token ADD CONSTRAINT FK_55394BDD41DEE7B9 FOREIGN KEY (token_id) REFERENCES token (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE token_user ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE token_user ADD CONSTRAINT FK_EF97E32BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_EF97E32BA76ED395 ON token_user (user_id)');
        $this->addSql('ALTER TABLE transaction ADD reciever_id INT NOT NULL, ADD sender_id INT NOT NULL, ADD token_id INT NOT NULL');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D15D5C928D FOREIGN KEY (reciever_id) REFERENCES token_user (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1F624B39D FOREIGN KEY (sender_id) REFERENCES token_user (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D141DEE7B9 FOREIGN KEY (token_id) REFERENCES token (id)');
        $this->addSql('CREATE INDEX IDX_723705D15D5C928D ON transaction (reciever_id)');
        $this->addSql('CREATE INDEX IDX_723705D1F624B39D ON transaction (sender_id)');
        $this->addSql('CREATE INDEX IDX_723705D141DEE7B9 ON transaction (token_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE token_user_token');
        $this->addSql('ALTER TABLE token_user DROP FOREIGN KEY FK_EF97E32BA76ED395');
        $this->addSql('DROP INDEX IDX_EF97E32BA76ED395 ON token_user');
        $this->addSql('ALTER TABLE token_user DROP user_id');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D15D5C928D');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1F624B39D');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D141DEE7B9');
        $this->addSql('DROP INDEX IDX_723705D15D5C928D ON transaction');
        $this->addSql('DROP INDEX IDX_723705D1F624B39D ON transaction');
        $this->addSql('DROP INDEX IDX_723705D141DEE7B9 ON transaction');
        $this->addSql('ALTER TABLE transaction DROP reciever_id, DROP sender_id, DROP token_id');
    }
}
