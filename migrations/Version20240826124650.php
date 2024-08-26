<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240826124650 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activity_registrations DROP FOREIGN KEY FK_520C98236146A8E4');
        $this->addSql('ALTER TABLE activity_registrations DROP FOREIGN KEY FK_520C98239D86650F');
        $this->addSql('DROP INDEX IDX_520C98239D86650F ON activity_registrations');
        $this->addSql('DROP INDEX IDX_520C98236146A8E4 ON activity_registrations');
        $this->addSql('ALTER TABLE activity_registrations ADD user_id INT NOT NULL, ADD activity_id INT NOT NULL, DROP user_id_id, DROP activity_id_id');
        $this->addSql('ALTER TABLE activity_registrations ADD CONSTRAINT FK_520C9823A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE activity_registrations ADD CONSTRAINT FK_520C982381C06096 FOREIGN KEY (activity_id) REFERENCES activities (id)');
        $this->addSql('CREATE INDEX IDX_520C9823A76ED395 ON activity_registrations (user_id)');
        $this->addSql('CREATE INDEX IDX_520C982381C06096 ON activity_registrations (activity_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activity_registrations DROP FOREIGN KEY FK_520C9823A76ED395');
        $this->addSql('ALTER TABLE activity_registrations DROP FOREIGN KEY FK_520C982381C06096');
        $this->addSql('DROP INDEX IDX_520C9823A76ED395 ON activity_registrations');
        $this->addSql('DROP INDEX IDX_520C982381C06096 ON activity_registrations');
        $this->addSql('ALTER TABLE activity_registrations ADD user_id_id INT NOT NULL, ADD activity_id_id INT NOT NULL, DROP user_id, DROP activity_id');
        $this->addSql('ALTER TABLE activity_registrations ADD CONSTRAINT FK_520C98236146A8E4 FOREIGN KEY (activity_id_id) REFERENCES activities (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE activity_registrations ADD CONSTRAINT FK_520C98239D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_520C98239D86650F ON activity_registrations (user_id_id)');
        $this->addSql('CREATE INDEX IDX_520C98236146A8E4 ON activity_registrations (activity_id_id)');
    }
}
