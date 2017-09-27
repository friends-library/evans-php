<?php

use Evans\Models\Tag;
use Phinx\Migration\AbstractMigration;

class CreateTagsTables extends AbstractMigration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->table('tags', ['id' => false, 'primary_key' => 'id'])
            ->addColumn('id', 'string', ['limit' => 36, 'null' => false])
            ->addColumn('name', 'string', ['limit' => 36, 'null' => false])
            ->addColumn('created_at', 'timestamp')
            ->addColumn('updated_at', 'timestamp')
            ->create();

        $this->table('documents_tags', ['id' => false])
            ->addColumn('document_id', 'string', ['limit' => 36, 'null' => false])
            ->addColumn('tag_id', 'string', ['limit' => 36, 'null' => false])
            ->addForeignKey('document_id', 'documents', 'id')
            ->addForeignKey('tag_id', 'tags', 'id')
            ->addColumn('created_at', 'timestamp')
            ->create();

        $tags = [
            Tag::LETTERS => 'letters',
            Tag::JOURNAL => 'journal',
            Tag::EXHORTATION => 'exhortation',
            Tag::DOCTRINAL => 'doctrinal',
            Tag::BIOGRAPHY => 'biography',
            Tag::COMPILATION => 'compilation',
            Tag::DEVOTIONAL => 'devotional',
            Tag::HISTORY => 'history',
            Tag::TREATISE => 'treatise',
        ];

        $insert = [];
        foreach ($tags as $id => $name) {
            $insert[] = [
                'id' => $id,
                'name' => $name,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }

        $this->table('tags')->insert($insert)->save();
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('documents_tags');
        $this->dropTable('tags');
    }
}
