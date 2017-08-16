<?php

namespace Evans\Infrastructure\Mappers;

use Evans\Models\Format;
use Evans\Models\Edition;

class FormatMapper extends EntityMapper
{
    /**
     * {@inheritdoc}
     */
    protected $class = Format::class;

    /**
     * Map db result to Format model
     *
     * @param array $result
     * @return Format
     */
    public function map(array $result): Format
    {
        $format = $this->mapEntity($result);

        if (isset($result['edition_id'])) {
            $edition = new Edition();
            $edition->setId($result['edition_id']);
            $format->setEdition($edition);
        }

        return $format;
    }
}
