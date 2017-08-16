<?php

namespace Evans\Http\Controllers;

use Evans\Infrastructure\Query\DocumentQuery;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DocumentController
{
    /**
     * @var DocumentQuery
     */
    protected $query;

    /**
     * @param DocumentQuery $query
     */
    public function __construct(DocumentQuery $query)
    {
        $this->query = $query;
    }

    /**
     * Respond to a GET /{friend_slug}/{document_slug} request
     *
     * @param string $friendSlug
     * @param string $documentSlug
     * @return void
     */
    public function get(string $friendSlug, string $documentSlug)
    {
        $document = $this->query
            ->whereFriendSlug($friendSlug)
            ->getBySlug($documentSlug);

        if (! $document) {
            throw new NotFoundHttpException("Document `{$documentSlug}` not found");
        }

        view('head');
        view('document/main', compact('document'));
        view('foot');
    }
}
