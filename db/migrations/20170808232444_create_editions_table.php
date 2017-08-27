<?php

use Phinx\Db\Adapter\MysqlAdapter;
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
            ->addColumn('pages', 'integer', [
                'limit' => MysqlAdapter::INT_SMALL,
                'null' => false
            ])
            ->addColumn('word_count', 'integer', [
                'limit' => MysqlAdapter::INT_MEDIUM,
                'null' => false
            ])
            ->addColumn('seconds', 'integer', [
                'limit' => MysqlAdapter::INT_SMALL,
                'null' => false
            ])
            ->addColumn('description', 'text', ['null' => true])
            ->addColumn('document_id', 'string', ['limit' => 36, 'null' => false])
            ->addForeignKey('document_id', 'documents', 'id', ['delete' => 'CASCADE'])
            ->addColumn('created_at', 'timestamp')
            ->addColumn('updated_at', 'timestamp')
            ->create();
    }
}
