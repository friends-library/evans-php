<?php

use Phinx\Migration\AbstractMigration;

class CreateEditionsTable extends AbstractMigration
{
    /**
     * Change Method
     */
    public function change()
    {
        $types = ['original', 'updated', 'modernized'];

        $this->table('editions', ['id' => false, 'primary_key' => 'id'])
            ->addColumn('id', 'string', ['limit' => 36, 'null' => false])
            ->addColumn('type', 'enum', ['values' => $types, 'null' => false])
            ->addColumn('document_id', 'string', ['limit' => 36, 'null' => false])
            ->addForeignKey('document_id', 'documents', 'id', ['delete' => 'CASCADE'])
            ->addColumn('created_at', 'timestamp')
            ->addColumn('updated_at', 'timestamp')
            ->create();
    }
}
