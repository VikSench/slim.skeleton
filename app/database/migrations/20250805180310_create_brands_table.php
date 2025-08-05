<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateBrandsTable extends AbstractMigration
{
    public function up(): void
    {
        $brands = $this->table('brands');
        $brands->addColumn('name', 'string', [
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
        ->addIndex(['name'], ['name' => 'idx_brand_name_prefix', 'limit' => [8]])
        ->create();
    }

    public function down(): void
    {
        $this->table('brands')->drop()->save();
    }
}
