<?php

namespace Evans\Models;

class Asset extends Entity
{
    /**
     * @var Format
     */
    protected $format;

    /**
     * Set the asset format
     *
     * @param Format $format
     */
    public function setFormat(Format $format): void
    {
        $this->format = $format;
    }

    /**
     * Get the asset format
     *
     * @return Format
     */
    public function getFormat(): Format
    {
        return $format;
    }
}
