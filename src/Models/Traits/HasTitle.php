<?php

namespace Evans\Models\Traits;

trait HasTitle
{
    /**
     * @var string
     */
    protected $title;

    /**
     * Set the model's title
     *
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Get the model's title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
}
