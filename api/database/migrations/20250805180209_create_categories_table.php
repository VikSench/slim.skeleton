<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateCategoriesTable extends AbstractMigration
{
    public function up(): void
    {
        $categories = $this->table('categories');
        $categories->addColumn('name', 'string', [
            'limit' => 100,
            'null' => false,
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
        $this->table('categories')->drop()->save();
    }
}
