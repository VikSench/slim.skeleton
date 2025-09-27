<?php declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUsersTable extends AbstractMigration
{
    public function up(): void
     {
        $table = $this->table('users');

        $table
            ->addColumn('email', 'text')
            ->addColumn('email_hash', 'char', ['limit' => 64])
            ->addColumn('password', 'char', ['limit' => 60])
            ->addColumn('full_name', 'string', ['limit' => 41, 'null' => true])
            ->addColumn('first_name', 'string', ['limit' => 20, 'null' => true])
            ->addColumn('last_name', 'string', ['limit' => 20, 'null' => true])
            ->addColumn('status', 'tinyinteger', ['default' => 0])
            ->addColumn('role', 'tinyinteger', ['default' => 0])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
            ])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP',
            ])
            ->addIndex(['email_hash'], ['unique' => true])
            ->addIndex(['status'])
            ->addIndex(['email_hash', 'status'])
            ->create();
    }

    public function down(): void
    {
        $this->table('users')->drop()->save();
    }
}
