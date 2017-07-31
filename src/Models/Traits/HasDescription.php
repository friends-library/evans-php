<?php

namespace Evans\Models\Traits;

trait HasDescription
{
    /**
     * @var string
     */
    protected $description;

    /**
     * Set the model's description
     *
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * Get the model's description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}
