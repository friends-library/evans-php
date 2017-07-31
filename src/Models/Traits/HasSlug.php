<?php

namespace Evans\Models\Traits;

trait HasSlug
{
    /**
     * @var string
     */
    protected $slug;

    /**
     * Set the model's slug
     *
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * Get the model's slug
     *
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }
}
