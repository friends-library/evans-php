<?php

namespace Evans\Infrastructure\Mappers;

use Evans\Models\Document;
use Evans\Models\Chapter;

class ChapterMapper extends EntityMapper
{
    /**
     * {@inheritdoc}
     */
    protected $class = Chapter::class;

    /**
     * Map a db result to a Chapter model
     *
     * @param array $result
     * @return Chapter
     */
    public function map(array $result): Chapter
    {
        $chapter = $this->mapEntity($result);
        $chapter->setOrder((int) $result['chapter_order']);

        // shallow reference to the document
        if ($result['document_id']) {
            $document = new Document();
            $document->setId($result['document_id']);
            $chapter->setDocument($document);
        }

        return $chapter;
    }
}
