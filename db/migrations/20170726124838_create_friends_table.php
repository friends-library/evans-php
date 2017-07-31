<?php

use Phinx\Migration\AbstractMigration;

class CreateFriendsTable extends AbstractMigration
{
    /**
     * Change Method
     */
    public function change()
    {
        $this->table('friends', ['id' => false, 'primary_key' => 'id'])
            ->addColumn('id', 'string', ['limit' => 36, 'null' => false])
            ->addColumn('name', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('slug', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('description', 'text', ['null' => true])
            ->addColumn('created_at', 'timestamp')
            ->addColumn('updated_at', 'timestamp')
            ->create();
    }
}
