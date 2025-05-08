<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250508155818 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA gog
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE gog.albums (id SERIAL NOT NULL, album_id INT NOT NULL, title VARCHAR(255) NOT NULL, year INT NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_53E734851137ABCF ON gog.albums (album_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE contribution (id SERIAL NOT NULL, gear_id INT DEFAULT NULL, music_id INT DEFAULT NULL, user_u_id INT DEFAULT NULL, date DATE NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_EA351E1577201934 ON contribution (gear_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_EA351E15399BBB13 ON contribution (music_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_EA351E159E24DF59 ON contribution (user_u_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE gog.gears (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, brand VARCHAR(255) NOT NULL, discr VARCHAR(255) NOT NULL, effect VARCHAR(255) DEFAULT NULL, power INT DEFAULT NULL, technology VARCHAR(255) DEFAULT NULL, year INT DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE gog.guitarists (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, groupname VARCHAR(255) NOT NULL, bio VARCHAR(255) NOT NULL, date DATE NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE gog.musics (id SERIAL NOT NULL, album_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_2ACF466D1137ABCF ON gog.musics (album_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE gog.users (id SERIAL NOT NULL, pseudo VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, is_admin BOOLEAN NOT NULL, genre VARCHAR(255) NOT NULL, favoritegroup VARCHAR(255) NOT NULL, bio VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN messenger_messages.created_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN messenger_messages.available_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN messenger_messages.delivered_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
                BEGIN
                    PERFORM pg_notify('messenger_messages', NEW.queue_name::text);
                    RETURN NEW;
                END;
            $$ LANGUAGE plpgsql;
        SQL);
        $this->addSql(<<<'SQL'
            DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE gog.albums ADD CONSTRAINT FK_53E734851137ABCF FOREIGN KEY (album_id) REFERENCES gog.musics (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contribution ADD CONSTRAINT FK_EA351E1577201934 FOREIGN KEY (gear_id) REFERENCES gog.gears (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contribution ADD CONSTRAINT FK_EA351E15399BBB13 FOREIGN KEY (music_id) REFERENCES gog.musics (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contribution ADD CONSTRAINT FK_EA351E159E24DF59 FOREIGN KEY (user_u_id) REFERENCES gog.users (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE gog.musics ADD CONSTRAINT FK_2ACF466D1137ABCF FOREIGN KEY (album_id) REFERENCES gog.albums (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE gog.albums DROP CONSTRAINT FK_53E734851137ABCF
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contribution DROP CONSTRAINT FK_EA351E1577201934
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contribution DROP CONSTRAINT FK_EA351E15399BBB13
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contribution DROP CONSTRAINT FK_EA351E159E24DF59
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE gog.musics DROP CONSTRAINT FK_2ACF466D1137ABCF
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE gog.albums
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE contribution
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE gog.gears
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE gog.guitarists
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE gog.musics
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE gog.users
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
