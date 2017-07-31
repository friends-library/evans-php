<?php

namespace Evans\Models\Traits;

trait IsEntity
{
    /**
     * @var string
     */
    protected $id;

    /**
     * Set the entity id
     *
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * Get the entity id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}
