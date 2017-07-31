<?php

namespace Evans\Infrastructure\Mappers;

use Cake\Chronos\Chronos;
use Evans\Models\Friend;

class FriendMapper
{
    /**
     * Map db result to Friend model
     *
     * @param array $result
     * @return Friend
     */
    public function map(array $result): Friend
    {
        $friend = new Friend();
        $friend->setId($result['id']);
        $friend->setName($result['name']);
        $friend->setSlug($result['slug']);
        $friend->setDescription($result['description']);

        $created = Chronos::createFromFormat(
            'Y-m-d H:i:s',
            $result['created_at']
        );
        $friend->setCreatedAt($created);

        $updated = Chronos::createFromFormat(
            'Y-m-d H:i:s',
            $result['updated_at']
        );
        $friend->setUpdatedAt($updated);

        return $friend;
    }
}
