<?php

namespace Evans\Models;

use Evans\Models\Traits\HasType;
use Evans\Models\Traits\HasDocument;

class Edition extends Entity
{
    use HasType;
    use HasDocument;

    /**
     * @var array<Format>
     */
    protected $formats = [];

    /**
     * Set formats
     *
     * @param array<Format> $formats
     */
    public function setFormats(array $formats): void
    {
        $this->formats = [];
        foreach ($formats as $format) {
            $this->addFormat($format);
        }
    }

    /**
     * Add a format
     *
     * @param Format $format
     */
    public function addFormat(Format $format): void
    {
        $this->formats[] = $format;
    }

    /**
     * Get formats
     *
     * @return array<Format>
     */
    public function getFormats(): array
    {
        return $this->formats;
    }
}
