<?php

namespace Evans\Infrastructure\Query;

use Evans\Models\Document;
use Doctrine\DBAL\Query\QueryBuilder;
use Evans\Infrastructure\Mappers\FriendMapper;

class DocumentQuery
{
    /**
     * @var QueryBuilder
     */
    protected $db;

    /**
     * @var FriendMapper
     */
    protected $mapper;

    /**
     * @var string
     */
    protected $friendSlug;

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
     * Scope query to a specific friend by slug
     *
     * @param string $friendSlug
     * @return $this
     */
    public function whereFriendSlug(string $friendSlug)
    {
        $this->friendSlug = $friendSlug;
        return $this;
    }

    /**
     * Get friend by slug
     *
     * @param string $slug
     * @return ?Document
     */
    public function getBySlug(string $slug): ?Document
    {
        $results = $this->db
            ->select(
                'fr.id as friend_id',
                'fr.name as friend_name',
                'fr.slug as friend_slug',
                'fr.description as friend_description',
                'fr.created_at as friend_created_at',
                'fr.updated_at as friend_updated_at',
                'd.id as document_id',
                'd.title as document_title',
                'd.slug as document_slug',
                'd.description as document_description',
                'd.created_at as document_created_at',
                'd.updated_at as document_updated_at',
                'c.id as chapter_id',
                'c.title as chapter_title',
                'c.order as chapter_order',
                'c.created_at as chapter_created_at',
                'c.updated_at as chapter_updated_at',
                'e.id as edition_id',
                'e.type as edition_type',
                'e.pages as edition_pages',
                'e.word_count as edition_word_count',
                'e.seconds as edition_seconds',
                'e.description as edition_description',
                'e.created_at as edition_created_at',
                'e.updated_at as edition_updated_at',
                'fm.id as format_id',
                'fm.type as format_type',
                'fm.created_at as format_created_at',
                'fm.updated_at as format_updated_at'
            )
            ->from('friends', 'fr')
            ->leftJoin('fr', 'documents', 'd', 'd.friend_id = fr.id')
            ->leftJoin('d', 'editions', 'e', 'e.document_id = d.id')
            ->leftJoin('d', 'chapters', 'c', 'c.edition_id = e.id')
            ->leftJoin('e', 'formats', 'fm', 'fm.edition_id = e.id')
            ->where('fr.slug = :friend_slug')
            ->andWhere('d.slug = :document_slug')
            ->setParameter('friend_slug', $this->friendSlug)
            ->setParameter('document_slug', $slug)
            ->execute()
            ->fetchAll();

        unset($this->friendSlug); // reset query state

        if (empty($results)) {
            return null;
        }

        $friend = $this->mapper->map($results);
        return $friend->getDocuments()[0];
    }
}
