<?php

namespace Evans\Models;

use Evans\Models\Traits\HasTitle;
use Evans\Models\Traits\HasEdition;

class Chapter extends Entity
{
    use HasTitle;
    use HasEdition;

    /**
     * @var int
     */
    protected $order;

    /**
     * Set the chapter's order
     *
     * @param int $order
     */
    public function setOrder(int $order): void
    {
        $this->order = $order;
    }

    /**
     * Get the chapter's order
     *
     * @return int
     */
    public function getOrder(): int
    {
        return $this->order;
    }
}
