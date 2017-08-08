<?php

use Phinx\Migration\AbstractMigration;

class CreateAssetsTable extends AbstractMigration
{
    /**
     * Change Method
     */
    public function change()
    {
        $this->table('assets', ['id' => false, 'primary_key' => 'id'])
            ->addColumn('id', 'string', ['limit' => 36, 'null' => false])
            ->addColumn('format_id', 'string', ['limit' => 36, 'null' => false])
            ->addForeignKey('format_id', 'formats', 'id', ['delete' => 'CASCADE'])
            ->addColumn('chapter_id', 'string', ['limit' => 36, 'null' => true])
            ->addColumn('created_at', 'timestamp')
            ->addColumn('updated_at', 'timestamp')
            ->create();
    }
}
