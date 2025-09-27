<?php declare(strict_types=1);

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateBrokersTable extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('brokers', [
            'id' => false,
            'primary_key' => 'id'
        ]);

        $table
            ->addColumn('id', 'integer', [
                'identity' => true,
                'signed' => false,
                'limit' => MysqlAdapter::INT_REGULAR
            ])
            ->addColumn('name', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('alias', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('referal_link', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('founded_year', 'integer', [
                'limit' => MysqlAdapter::INT_SMALL,
                'signed' => false,
                'null' => true
            ])
            ->addColumn('max_leverage', 'integer', [
                'signed' => false,
                'null' => true
            ])
            ->addColumn('rating', 'integer', [
                'limit' => MysqlAdapter::INT_TINY,
                'signed' => false,
                'default' => 0,
                'null' => true
            ])
            ->addColumn('status', 'integer', [
                'limit' => MysqlAdapter::INT_TINY,
                'signed' => false,
                'default' => 0,
                'null' => false
            ])
            ->addColumn('created_at', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'null' => false
            ])
            ->addColumn('updated_at', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP',
                'null' => false
            ])
            ->addIndex(['alias'], ['unique' => true])
            ->create();
    }

    public function down()
    {
        $this->table('brokers')->drop()->save();
    }
}