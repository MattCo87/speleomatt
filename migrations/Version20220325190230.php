<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220325190230 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE action (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, power INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE action_strategy (id INT AUTO_INCREMENT NOT NULL, actions_id INT DEFAULT NULL, strategies_id INT DEFAULT NULL, position_action VARCHAR(255) DEFAULT NULL, INDEX IDX_C391358BB15F4BF6 (actions_id), INDEX IDX_C391358B529B93AD (strategies_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, level INT NOT NULL, attack INT NOT NULL, defense INT NOT NULL, resistance INT NOT NULL, speed INT NOT NULL, ispremade TINYINT(1) NOT NULL, INDEX IDX_937AB034A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE character_formation (id INT AUTO_INCREMENT NOT NULL, characters_id INT DEFAULT NULL, formations_id INT DEFAULT NULL, position_character VARCHAR(255) NOT NULL, INDEX IDX_C7108384C70F0E28 (characters_id), INDEX IDX_C71083843BF5B0C2 (formations_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE character_strategy (id INT AUTO_INCREMENT NOT NULL, characters_id INT DEFAULT NULL, strategies_id INT DEFAULT NULL, position_strategie VARCHAR(255) DEFAULT NULL, INDEX IDX_4C47AC7CC70F0E28 (characters_id), INDEX IDX_4C47AC7C529B93AD (strategies_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fight (id INT AUTO_INCREMENT NOT NULL, log LONGTEXT DEFAULT NULL, createdat DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_404021BFA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation_fight (formation_id INT NOT NULL, fight_id INT NOT NULL, INDEX IDX_5721DA235200282E (formation_id), INDEX IDX_5721DA23AC6657E4 (fight_id), PRIMARY KEY(formation_id, fight_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE strategy (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, fight_id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL, experience INT NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649AC6657E4 (fight_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE action_strategy ADD CONSTRAINT FK_C391358BB15F4BF6 FOREIGN KEY (actions_id) REFERENCES action (id)');
        $this->addSql('ALTER TABLE action_strategy ADD CONSTRAINT FK_C391358B529B93AD FOREIGN KEY (strategies_id) REFERENCES strategy (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE character_formation ADD CONSTRAINT FK_C7108384C70F0E28 FOREIGN KEY (characters_id) REFERENCES `character` (id)');
        $this->addSql('ALTER TABLE character_formation ADD CONSTRAINT FK_C71083843BF5B0C2 FOREIGN KEY (formations_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE character_strategy ADD CONSTRAINT FK_4C47AC7CC70F0E28 FOREIGN KEY (characters_id) REFERENCES `character` (id)');
        $this->addSql('ALTER TABLE character_strategy ADD CONSTRAINT FK_4C47AC7C529B93AD FOREIGN KEY (strategies_id) REFERENCES strategy (id)');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE formation_fight ADD CONSTRAINT FK_5721DA235200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_fight ADD CONSTRAINT FK_5721DA23AC6657E4 FOREIGN KEY (fight_id) REFERENCES fight (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649AC6657E4 FOREIGN KEY (fight_id) REFERENCES fight (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE action_strategy DROP FOREIGN KEY FK_C391358BB15F4BF6');
        $this->addSql('ALTER TABLE character_formation DROP FOREIGN KEY FK_C7108384C70F0E28');
        $this->addSql('ALTER TABLE character_strategy DROP FOREIGN KEY FK_4C47AC7CC70F0E28');
        $this->addSql('ALTER TABLE formation_fight DROP FOREIGN KEY FK_5721DA23AC6657E4');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649AC6657E4');
        $this->addSql('ALTER TABLE character_formation DROP FOREIGN KEY FK_C71083843BF5B0C2');
        $this->addSql('ALTER TABLE formation_fight DROP FOREIGN KEY FK_5721DA235200282E');
        $this->addSql('ALTER TABLE action_strategy DROP FOREIGN KEY FK_C391358B529B93AD');
        $this->addSql('ALTER TABLE character_strategy DROP FOREIGN KEY FK_4C47AC7C529B93AD');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034A76ED395');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BFA76ED395');
        $this->addSql('DROP TABLE action');
        $this->addSql('DROP TABLE action_strategy');
        $this->addSql('DROP TABLE `character`');
        $this->addSql('DROP TABLE character_formation');
        $this->addSql('DROP TABLE character_strategy');
        $this->addSql('DROP TABLE fight');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE formation_fight');
        $this->addSql('DROP TABLE strategy');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
