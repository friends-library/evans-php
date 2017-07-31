<?php

namespace Evans\Infrastructure\Query;

use Evans\Models\Friend;
use Doctrine\DBAL\Query\QueryBuilder;
use Evans\Infrastructure\Mappers\FriendMapper;

class FriendQuery
{
    /**
     * @var QueryBuilder
     */
    protected $db;

    /**
     * @param QueryBuilder $db
     * @param FriendMapper $mapper
     */
    public function __construct(QueryBuilder $db, FriendMapper $mapper)
    {
        $this->db = $db;
        $this->mapper = $mapper;
    }

    /**
     * Get friend by slug
     *
     * @param string $slug
     * @return ?Friend
     */
    public function getBySlug(string $slug): ?Friend
    {
        $results = $this->db
            ->select('*')
            ->from('friends')
            ->where('slug = :slug')
            ->setParameter('slug', $slug)
            ->execute()
            ->fetchAll();

        if (empty($results)) {
            return null;
        }

        return $this->mapper->map($results[0]);
    }
}
