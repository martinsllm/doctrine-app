<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260312000236 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Criação de tabela de testes';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->createTable('test');
        $table->addColumn('id', 'integer', ['autoincrement' => true, 'notnull' => true]);
        $table->addColumn('name', 'string', ['notnull' => true]);
        
        $table->setPrimaryKey(['id']);;
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('test');
    }
}
