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
     * @var FormatMapper
     */
    protected $formatMapper;

    /**
     * @param FormatMapper $formatMapper
     */
    public function __construct(FormatMapper $formatMapper)
    {
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

        // shallow reference to the document
        if (isset($results[0]['document_id'])) {
            $document = new Document();
            $document->setId($results[0]['document_id']);
            $edition->setDocument($document);
        }

        $formats = $this->mapFormats($results, $edition);
        $edition->setFormats($formats);

        return $edition;
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
