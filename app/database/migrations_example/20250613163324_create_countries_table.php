<?php declare(strict_types=1);

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateCountriesTable extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('countries', [
            'id' => false,
            'primary_key' => 'id'
        ]);

        $table
            ->addColumn('id', 'integer', [
                'limit' => MysqlAdapter::INT_SMALL,
                'signed' => false,
                'identity' => true
            ])
            ->addColumn('code', 'string', ['limit' => 3, 'null' => false])
            ->addColumn('name', 'string', ['limit' => 100, 'null' => false])
            ->create();
    }

    public function down()
    {
        $this->table('countries')->drop()->save();
    }
}
