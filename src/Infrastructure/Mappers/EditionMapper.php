<?php

namespace Evans\Infrastructure\Mappers;

use Evans\Models\Document;
use Evans\Models\Edition;

class EditionMapper extends EntityMapper
{
    /**
     * {@inheritdoc}
     */
    protected $class = Edition::class;

    /**
     * @var ChapterMapper
     */
    protected $chapterMapper;

    /**
     * @var FormatMapper
     */
    protected $formatMapper;

    /**
     * @param ChapterMapper $chapterMapper
     * @param FormatMapper $formatMapper
     */
    public function __construct(
        ChapterMapper $chapterMapper,
        FormatMapper $formatMapper
    ) {
        $this->chapterMapper = $chapterMapper;
        $this->formatMapper = $formatMapper;
    }

    /**
     * Map db results to Edition model
     *
     * @param array $results
     * @return Edition
     */
    public function map(array $results): Edition
    {
        $edition = $this->mapEntity($results[0]);
        $edition->setPages((int) $results[0]['edition_pages']);

        // shallow reference to the document
        if (isset($results[0]['document_id'])) {
            $document = new Document();
            $document->setId($results[0]['document_id']);
            $edition->setDocument($document);
        }

        $edition->setWordCount((int) $results[0]['edition_word_count']);
        $edition->setSeconds((int) $results[0]['edition_seconds']);

        $formats = $this->mapFormats($results, $edition);
        $edition->setFormats($formats);

        $chapters = $this->mapChapters($results, $edition);
        $edition->setChapters($chapters);

        return $edition;
    }

    /**
     * Map db results to edition chapters
     *
     * @param array $results
     * @param Edition $edition
     * @return array<Chapter>
     */
    protected function mapChapters(array $results, Edition $edition): array
    {
        $chapters = [];
        foreach ($results as $result) {
            $chapterId = $result['chapter_id'];
            if (isset($chapters[$chapterId])) {
                continue;
            }

            $chapter = $this->chapterMapper->map($result);
            $chapter->setEdition($edition);
            $chapters[$chapterId] = $chapter;
        }

        return array_values($chapters);
    }

    /**
     * Map db results to edition formats
     *
     * @param array $results
     * @param Edition $edition
     * @return array<Format>
     */
    protected function mapFormats(array $results, Edition $edition): array
    {
        $formats = [];
        foreach ($results as $result) {
            $formatId = $result['format_id'];
            if (isset($formats[$formatId])) {
                continue;
            }

            $format = $this->formatMapper->map($result);
            $format->setEdition($edition);
            $formats[$formatId] = $format;
        }

        return array_values($formats);
    }
}
