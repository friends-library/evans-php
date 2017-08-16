<?php

use Phinx\Seed\AbstractSeed;

class BDocumentSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        // documents
        $docs = [
            [
                'id' => '9a1ff658-cdac-4707-82a0-cafd9ded7a7a',
                'title' => 'The Diary and Letters of Rebecca Jones',
                'slug' => 'diary-and-letters',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                'friend_id' => 'd7d91b7a-dc84-4e3a-8c83-2812eff5f06e',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];

        $this->table('documents')->insert($docs)->save();


        // chapters
        $chapters = [
            [
                'id' => '230f764c-b342-47d4-a8a0-0ffa9bd88cd6',
                'title' => 'Chapter 1',
                'order' => 1,
                'document_id' => '9a1ff658-cdac-4707-82a0-cafd9ded7a7a',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 'b1cd7d93-366c-40fe-b5f7-2141ee50a819',
                'title' => 'Chapter 2',
                'order' => 2,
                'document_id' => '9a1ff658-cdac-4707-82a0-cafd9ded7a7a',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];

        $this->table('chapters')->insert($chapters)->save();


        // editions
        $editions = [
            [
                'id' => '818e26c0-bd5b-445c-8821-166ee18064f2',
                'type' => 'original',
                'document_id' => '9a1ff658-cdac-4707-82a0-cafd9ded7a7a',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 'cb1f8c63-0d42-4d39-993b-a7f34ef3ed52',
                'type' => 'updated',
                'document_id' => '9a1ff658-cdac-4707-82a0-cafd9ded7a7a',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];

        $this->table('editions')->insert($editions)->save();


        // formats
        $formats = [
            [
                'id' => 'f2d2ee03-87e6-45e4-8c50-c8794b8a7834',
                'type' => 'pdf',
                'edition_id' => '818e26c0-bd5b-445c-8821-166ee18064f2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '89f79e81-d310-4f1b-9391-8563b89a9a35',
                'type' => 'mobi',
                'edition_id' => '818e26c0-bd5b-445c-8821-166ee18064f2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '7af0682f-c229-4835-aea1-c2fb0c3e1771',
                'type' => 'pdf',
                'edition_id' => 'cb1f8c63-0d42-4d39-993b-a7f34ef3ed52',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->table('formats')->insert($formats)->save();
    }
}
