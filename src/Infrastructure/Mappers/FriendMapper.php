<?php

namespace Evans\Infrastructure\Mappers;

use Evans\Models\Friend;
use Evans\Models\Entity;

class FriendMapper extends EntityMapper
{
    /**
     * {@inheritdoc}
     */
    protected $class = Friend::class;

    /**
     * @var DocumentMapper
     */
    protected $documentMapper;

    /**
     * @param DocumentMapper $documentMapper
     */
    public function __construct(DocumentMapper $documentMapper)
    {
        $this->documentMapper = $documentMapper;
    }

    /**
     * Map db result to Friend model
     *
     * @param array $results
     * @return Friend
     */
    public function map(array $results): Friend
    {
        $friend = $this->mapEntity($results[0]);
        $documents = $this->mapDocuments($results, $friend);
        $friend->setDocuments($documents);
        return $friend;
    }

    /**
     * Map the documents
     *
     * @param array $results
     * @param Friend $friend
     * @return array<Document>
     */
    protected function mapDocuments(array $results, Friend $friend): array
    {
        $grouped = [];
        foreach ($results as $result) {
            $documentId = $result['document_id'];
            if (! isset($grouped[$documentId])) {
                $grouped[$documentId] = [];
            }
            $grouped[$documentId][] = $result;
        }

        $documents = [];
        foreach ($results as $result) {
            $documentId = $result['document_id'];
            if (! $documentId || isset($documents[$documentId])) {
                continue;
            }

            $document = $this->documentMapper->map($grouped[$documentId]);
            $document->setFriend($friend);
            $documents[$documentId] = $document;
        }

        return array_values($documents);
    }
}
