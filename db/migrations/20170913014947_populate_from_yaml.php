<?php

use Webpatser\Uuid\Uuid;
use Symfony\Component\Yaml\Yaml;
use Phinx\Migration\AbstractMigration;

class PopulateFromYaml extends AbstractMigration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $friends = [
            'rebecca-jones',
            'isaac-penington',
            'robert-barclay',
            'john-gratton',
            'john-burnyeat',
            'stephen-crisp',
            'catherine-payton-phillips',
            'john-griffeth',
            'thomas-story',
        ];
        foreach ($friends as $slug) {
            $this->addFriend($slug);
        }
    }

    /**
     * Add friend to db by slug
     *
     * @param string $slug
     */
    protected function addFriend(string $slug): void
    {
        $file = __DIR__ . "/../yaml/{$slug}.yml";
        $contents = file_get_contents($file);
        $friend = Yaml::parse($contents);
        $friend['id'] = (string) Uuid::generate(4);
        $this->table('friends')->insert([[
            'id' => $friend['id'],
            'name' => $friend['name'],
            'slug' => $friend['slug'],
            'description' => $friend['description'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]])->save();

        foreach ($friend['documents'] as $document) {
            $this->addDocument($document, $friend['id']);
        }
    }

    /**
     * Add document
     *
     * @param array $document
     * @param string $friendId
     */
    protected function addDocument(array $document, string $friendId): void
    {
        $document['id'] = (string) Uuid::generate(4);
        $this->table('documents')->insert([[
            'id' => $document['id'],
            'title' => $document['title'],
            'slug' => $document['slug'],
            'description' => $document['description'] ?? '',
            'friend_id' => $friendId,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]])->save();

        foreach ($document['editions'] as $edition) {
            $this->addEdition($edition, $document['id']);
        }
    }

    /**
     * Add edition
     *
     * @param array $edition
     * @param string $documentId
     */
    protected function addEdition(array $edition, string $documentId): void
    {
        $edition['id'] = (string) Uuid::generate(4);
        $this->table('editions')->insert([[
            'id' => $edition['id'],
            'type' => $edition['type'],
            'pages' => (int) $edition['pages'],
            'word_count' => $edition['word_count'] ?? 0,
            'seconds' => $edition['seconds'] ?? 0,
            'document_id' => $documentId,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]])->save();

        foreach ($edition['chapters'] as $index => $chapter) {
            $this->addChapter($chapter, $index + 1, $edition['id']);
        }

        foreach ($edition['formats'] as $format) {
            $this->addFormat($format, $edition['id']);
        }
    }

    /**
     * Add chapter
     *
     * @param array $chapter
     * @param int $order
     * @param string $editionId
     */
    protected function addChapter(array $chapter, int $order, string $editionId): void
    {
        $chapter['id'] = (string) Uuid::generate(4);
        $this->table('chapters')->insert([[
            'id' => $chapter['id'],
            'title' => $chapter['title'],
            'order' => $order,
            'edition_id' => $editionId,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]])->save();
    }

    /**
     * Add format
     *
     * @param array $format
     * @param string $editionId
     */
    protected function addFormat(array $format, string $editionId): void
    {
        $format['id'] = (string) Uuid::generate(4);
        $this->table('formats')->insert([[
            'id' => $format['id'],
            'type' => $format['type'],
            'edition_id' => $editionId,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]])->save();
    }
}
