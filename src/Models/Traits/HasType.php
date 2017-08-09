<?php

namespace Evans\Models\Traits;

trait HasType
{
    /**
     * @var string
     */
    protected $type;

    /**
     * Set the model's type
     *
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * Get the model's type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
