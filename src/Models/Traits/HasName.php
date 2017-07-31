<?php

namespace Evans\Models\Traits;

trait HasName
{
    /**
     * @var string
     */
    protected $name;

    /**
     * Set the model's name
     *
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Get the model's name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
