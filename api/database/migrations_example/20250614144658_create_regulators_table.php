<?php

declare(strict_types=1);

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

final class CreateRegulatorsTable extends AbstractMigration
{
    public function up(): void
    {
        $table = $this->table('regulators');
        $table
            ->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('abbreviation', 'string', ['limit' => 50, 'null' => true])
            ->addColumn('country_id', 'integer', [
                'limit' => MysqlAdapter::INT_SMALL,
                'signed' => false,
            ])
            ->addColumn('description', 'text', ['null' => true])
            ->addForeignKey('country_id', 'countries', 'id', [
                'delete'=> 'RESTRICT',
                'update'=> 'CASCADE'
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
            ])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP',
            ])
            ->create();
    }

    public function down(): void
    {
        $this->table('regulators')->drop()->save();
    }
}
