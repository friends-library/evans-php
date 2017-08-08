<?php

use Phinx\Migration\AbstractMigration;

class CreateFormatsTable extends AbstractMigration
{
    /**
     * Change Method
     */
    public function change()
    {
        $types = [
            'softcover',
            'audio',
            'pdf',
            'epub',
            'mobi',
        ];

        $this->table('formats', ['id' => false, 'primary_key' => 'id'])
            ->addColumn('id', 'string', ['limit' => 36, 'null' => false])
            ->addColumn('type', 'enum', ['values' => $types, 'null' => false])
            ->addColumn('edition_id', 'string', ['limit' => 36, 'null' => false])
            ->addForeignKey('edition_id', 'editions', 'id', ['delete' => 'CASCADE'])
            ->addColumn('created_at', 'timestamp')
            ->addColumn('updated_at', 'timestamp')
            ->create();
    }
}
