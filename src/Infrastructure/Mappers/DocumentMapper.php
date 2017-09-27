<?php

namespace Evans\Infrastructure\Mappers;

use Evans\Models\Friend;
use Evans\Models\Document;

class DocumentMapper extends EntityMapper
{
    /**
     * {@inheritdoc}
     */
    protected $class = Document::class;

    /**
     * @var EditionMapper
     */
    protected $editionMapper;

    /**
     * @var TagMapper
     */
    protected $tagMapper;

    /**
     * @param EditionMapper $editionMapper
     * @param TagMapper $tagMapper
     */
    public function __construct(
        EditionMapper $editionMapper,
        TagMapper $tagMapper
    ) {
        $this->editionMapper = $editionMapper;
        $this->tagMapper = $tagMapper;
    }

    /**
     * Map db results to Document model
     *
     * @param array $results
     * @return array<Document>
     */
    public function map(array $results): Document
    {
        $document = $this->mapEntity($results[0]);

        // shallow reference to the friend
        if (isset($results[0]['friend_id'])) {
            $friend = new Friend();
            $friend->setId($results[0]['friend_id']);
            $document->setFriend($friend);
        }

        $editions = $this->mapEditions($results, $document);
        $document->setEditions($editions);

        $tags = $this->mapTags($results, $document);
        $document->setTags($tags);

        return $document;
    }

    /**
     * Map db results to document editions
     *
     * @param array $results
     * @param Document $document
     * @return array<Edition>
     */
    protected function mapEditions(array $results, Document $document): array
    {
        $grouped = [];
        foreach ($results as $result) {
            $editionId = $result['edition_id'];
            if (! isset($grouped[$editionId])) {
                $grouped[$editionId] = [];
            }
            $grouped[$editionId][] = $result;
        }

        $editions = [];
        foreach ($results as $result) {
            $editionId = $result['edition_id'];
            if (isset($editions[$editionId])) {
                continue;
            }

            $edition = $this->editionMapper->map($grouped[$editionId]);
            $edition->setDocument($document);
            $editions[$editionId] = $edition;
        }

        return array_values($editions);
    }

    /**
     * Map db results to document tags
     *
     * @param array $results
     * @param Document $document
     * @return array<Tag>
     */
    protected function mapTags(array $results, Document $document): array
    {
        $tags = [];
        foreach ($results as $result) {
            $tagId = $result['tag_id'];
            if (! isset($tags[$tagId])) {
                $tag = $this->tagMapper->map($result);
                $tag->setDocument($document);
                $tags[$tagId] = $tag;
            }
        }

        return array_values($tags);
    }
}
