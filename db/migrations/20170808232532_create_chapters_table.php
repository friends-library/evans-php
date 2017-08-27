<?php

use Phinx\Migration\AbstractMigration;

class CreateChaptersTable extends AbstractMigration
{
    /**
     * Change Method
     */
    public function change()
    {
        $this->table('chapters', ['id' => false, 'primary_key' => 'id'])
            ->addColumn('id', 'string', ['limit' => 36, 'null' => false])
            ->addColumn('title', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('order', 'integer', ['signed' => false])
            ->addColumn('edition_id', 'string', ['limit' => 36, 'null' => false])
            ->addForeignKey('edition_id', 'editions', 'id', ['delete' => 'CASCADE'])
            ->addColumn('created_at', 'timestamp')
            ->addColumn('updated_at', 'timestamp')
            ->create();
    }
}
