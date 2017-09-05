<?php

use Phinx\Migration\AbstractMigration;

class CreateDownloadLogTable extends AbstractMigration
{
    /**
     * Change Method
     */
    public function change()
    {
        $this->table('downloads', ['id' => false, 'primary_key' => 'id'])
            ->addColumn('id', 'string', ['limit' => 36, 'null' => false])
            ->addColumn('format_id', 'string', ['limit' => 36, 'null' => false])
            ->addForeignKey('format_id', 'formats', 'id', ['delete' => 'CASCADE'])
            ->addColumn('chapter_id', 'string', ['limit' => 36, 'null' => false])
            ->addColumn('user_agent', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('ip', 'string', ['limit' => 45, 'null' => false])
            ->addColumn('created_at', 'timestamp')
            ->create();
    }
}
