<?php

namespace Evans\Infrastructure\Mappers;

use Evans\Models\Document;
use Evans\Models\Chapter;
use Evans\Models\Edition;

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

        // shallow reference to the edition
        if ($result['edition_id']) {
            $edition = new Edition();
            $edition->setId($result['edition_id']);
            $chapter->setEdition($edition);
        }

        return $chapter;
    }
}
