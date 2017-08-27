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
     * @param EditionMapper $editionMapper
     */
    public function __construct(EditionMapper $editionMapper)
    {
        $this->editionMapper = $editionMapper;
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
}
