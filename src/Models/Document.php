<?php

namespace Evans\Models;

use Evans\Models\Traits\HasTitle;
use Evans\Models\Traits\HasDescription;

class Document extends Entity
{
    use HasTitle;
    use HasDescription;

    /**
     * @var Friend
     */
    protected $friend;

    /**
     * Set the document's friend
     *
     * @param Friend $friend
     */
    public function setFriend(Friend $friend): void
    {
        $this->friend = $friend;
    }

    /**
     * Get the document's friend
     *
     * @return Friend $friend
     */
    public function getFriend(): Friend
    {
        return $this->friend;
    }
}
