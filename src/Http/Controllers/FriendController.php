<?php

namespace Evans\Http\Controllers;

use Evans\Infrastructure\Query\FriendQuery;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FriendController
{
    /**
     * @var FriendQuery
     */
    protected $query;

    /**
     * @param FriendQuery $query
     */
    public function __construct(FriendQuery $query)
    {
        $this->query = $query;
    }

    /**
     * Respond to a GET /friend/{slug} request
     *
     * @param string $slug
     * @return void
     */
    public function slug(string $slug)
    {
        $friend = $this->query->getBySlug($slug);
        if (! $friend) {
            throw new NotFoundHttpException("Friend with slug: $slug not found");
        }

        view('head');
        view('friend/main', compact('friend'));
        view('foot');
    }
}
