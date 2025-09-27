<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateProductsTable extends AbstractMigration
{
    public function up(): void
    {
        $products = $this->table('products', ['comment' => 'Товары — спортивное питание']);
        $products->addColumn('name', 'string', [
            'limit' => 255,
            'null' => false,
        ])
        ->addColumn('description', 'text', [
            'null' => true,
        ])
        ->addColumn('price', 'integer', [
            'null' => false,
            'default' => 0,
            'signed' => false,
        ])
        ->addColumn('brand_id', 'integer', [
            'null' => true,
            'signed' => false,
        ])
        ->addColumn('category_id', 'integer', [
            'null' => true,
            'signed' => false,
        ])
        ->addColumn('weight', 'integer', [
            'null' => true,
            'signed' => false,
        ])
        ->addColumn('created_at', 'timestamp', [
            'default' => 'CURRENT_TIMESTAMP',
        ])
        ->addColumn('updated_at', 'timestamp', [
            'default' => 'CURRENT_TIMESTAMP',
            'update' => 'CURRENT_TIMESTAMP',
        ])
        ->addIndex(['name'], ['name' => 'idx_name_prefix', 'limit' => [8]])
        ->addForeignKey('category_id', 'categories', 'id', [
            'delete'=> 'SET_NULL',
            'update'=> 'CASCADE',
            'constraint' => 'fk_products_category'
        ])
        ->addForeignKey('brand_id', 'brands', 'id', [
            'delete'=> 'SET_NULL',
            'update'=> 'CASCADE',
            'constraint' => 'fk_products_brand'
        ])
        ->create();
    }

    public function down(): void
    {
        $table = $this->table('products');

        if ($table->hasForeignKey('category_id')) {
            $table->dropForeignKey('category_id');
        }
        if ($table->hasForeignKey('brand_id')) {
            $table->dropForeignKey('brand_id');
        }

        $table->save();
        $table->drop()->save();
    }
}
