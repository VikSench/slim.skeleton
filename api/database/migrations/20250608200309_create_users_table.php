<?php declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUsersTable extends AbstractMigration
{
    public function up(): void
     {
        $table = $this->table('users');

        $table
            ->addColumn('email', 'varchar', ['limit' => 128])
            ->addColumn('password', 'char', ['limit' => 60])
            ->addColumn('full_name', 'char', ['limit' => 61, 'null' => true])
            ->addColumn('first_name', 'char', ['limit' => 30, 'null' => true])
            ->addColumn('last_name', 'char', ['limit' => 30, 'null' => true])
            ->addColumn('status', 'tinyinteger', ['default' => 0])
            ->addColumn('role', 'tinyinteger', ['default' => 0])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
            ])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP',
            ])
            ->addIndex(['email'], ['unique' => true])
            ->addIndex(['status'])
            ->addIndex(['email', 'status'])
            ->create();
    }

    public function down(): void
    {
        $this->table('users')->drop()->save();
    }
}
