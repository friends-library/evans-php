<?php

namespace Evans\Models;

use Evans\Models\Traits\HasType;

class Format extends Entity
{
    use HasType;

    /**
     * @var Edition
     */
    protected $edition;

    /**
     * Set edition
     *
     * @param Edition $edition
     */
    public function setEdition(Edition $edition): void
    {
        $this->edition = $edition;
    }

    /**
     * Get edition
     *
     * @return Edition
     */
    public function getEdition(): Edition
    {
        return $this->edition;
    }
}
