<?php

namespace Evans\Models\Traits;

use Evans\Models\Edition;

trait HasEdition
{
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
