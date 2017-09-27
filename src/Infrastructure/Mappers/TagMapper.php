<?php

namespace Evans\Infrastructure\Mappers;

use Evans\Models\Tag;
use Evans\Models\Document;

class TagMapper extends EntityMapper
{
    /**
     * {@inheritdoc}
     */
    protected $class = Tag::class;

    /**
     * Map db result to Tag model
     *
     * @param array $result
     * @return Tag
     */
    public function map(array $result): Tag
    {
        $tag = $this->mapEntity($result);

        // shallow reference to the document
        if (isset($result['document_id'])) {
            $document = new Document();
            $document->setId($result['document_id']);
            $tag->setDocument($document);
        }

        return $tag;
    }
}
