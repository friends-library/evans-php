<?php

use Phinx\Migration\AbstractMigration;

class CreateDocumentsTable extends AbstractMigration
{
    /**
     * Change Method
     */
    public function change()
    {
        $this->table('documents', ['id' => false, 'primary_key' => 'id'])
            ->addColumn('id', 'string', ['limit' => 36, 'null' => false])
            ->addColumn('title', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('slug', 'string', ['limit' => 100, 'null' => false])
            ->addColumn('description', 'text', ['null' => true])
            ->addColumn('friend_id', 'string', ['limit' => 36, 'null' => false])
            ->addForeignKey('friend_id', 'friends', 'id', ['delete' => 'CASCADE'])
            ->addColumn('created_at', 'timestamp')
            ->addColumn('updated_at', 'timestamp')
            ->create();
    }
}
