<?php

namespace Evans\Models\Traits;

use Cake\Chronos\Chronos;

trait IsAuditable
{
    /**
     * @var Chronos
     */
    protected $createdAt;

    /**
     * @var Chronos
     */
    protected $updatedAt;

    /**
     * Set created at time
     *
     * @param Chronos $createdAt
     */
    public function setCreatedAt(Chronos $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get created at time
     *
     * @return Chronos
     */
    public function getCreatedAt(): Chronos
    {
        return $this->createdAt;
    }

    /**
     * Set modified at time
     *
     * @param Chronos $updatedAt
     */
    public function setUpdatedAt(Chronos $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Get modified at time
     *
     * @return Chronos
     */
    public function getUpdatedAt(): Chronos
    {
        return $this->updatedAt;
    }
}
