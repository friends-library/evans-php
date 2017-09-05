<?php

namespace Evans\Http\Controllers;

use Evans\Models\Format;
use Evans\Models\Document;
use Webpatser\Uuid\Uuid;
use Doctrine\DBAL\Query\QueryBuilder;
use Evans\Infrastructure\Query\DocumentQuery;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DownloadController
{
    /**
     * @var QueryBuilder
     */
    protected $db;

    /**
     * @var DocumentQuery
     */
    protected $documentQuery;

    /**
     * @param QueryBuilder $db
     * @param DocumentQuery $documentQuery
     */
    public function __construct(
        QueryBuilder $db,
        DocumentQuery $documentQuery
    ) {
        $this->db = $db;
        $this->documentQuery = $documentQuery;
    }

    /**
     * Log a download request and redirect to static asset
     *
     * @param string $friendSlug
     * @param string $documentSlug
     * @param string $editionType
     * @param string $formatType
     * @param ?string $chapterSlug
     * @return RedirectResponse
     */
    public function logAndRedirect(
        string $friendSlug,
        string $documentSlug,
        string $editionType,
        string $formatType,
        ?string $chapterSlug = null
    ): RedirectResponse {
        $args = func_get_args();
        $this->log(...$args);
        $url = $this->getRedirectUrl(...$args);
        return new RedirectResponse($url);
    }

    /**
     * Get actual external asset url
     *
     * @param string $friendSlug
     * @param string $documentSlug
     * @param string $editionType
     * @param string $formatType
     * @param ?string $chapterSlug
     * @return string
     */
    public function getRedirectUrl(
        string $friendSlug,
        string $documentSlug,
        string $editionType,
        string $formatType,
        ?string $chapterSlug = null
    ): string {
        $filename = "{$friendSlug}-{$documentSlug}";
        if ($chapterSlug) {
            $filename .= "-{$chapterSlug}";
        }

        return join('/', [
            getenv('EXTERNAL_ASSET_URL_BASE'),
            $friendSlug,
            $documentSlug,
            $editionType,
            $filename,
        ]) . '.' . $formatType;
    }

    /**
     * Get format and optional chapter entity ids
     *
     * @param Document $document
     * @param string $editionType
     * @param string $formatType
     * @param ?string $chapterSlug
     * @return array<string>
     */
    protected function getEntityIds(
        Document $document,
        string $editionType,
        string $formatType,
        ?string $chapterSlug = null
    ): array {
        $chapterId = null;
        foreach ($document->getEditions() as $edition) {
            if ($edition->getType() !== $editionType) {
                continue;
            }

            if ($chapterSlug) {
                foreach ($edition->getChapters() as $chapter) {
                    if (slugify($chapter->getTitle()) === $chapterSlug) {
                        $chapterId = $chapter->getId();
                    }
                }
            }

            foreach ($edition->getFormats() as $format) {
                if ($format->getType() === $formatType) {
                    return [$format->getId(), $chapterId];
                }
            }
        }

        throw new NotFoundHttpException('Format not found for download');
    }

    /**
     * Log a download request
     *
     * @param string $friendSlug
     * @param string $documentSlug
     * @param string $editionType
     * @param string $formatType
     * @param ?string $chapterSlug
     * @return void
     */
    public function log(
        string $friendSlug,
        string $documentSlug,
        string $editionType,
        string $formatType,
        ?string $chapterSlug = null
    ) {
        $document = $this->documentQuery
            ->whereFriendSlug($friendSlug)
            ->getBySlug($documentSlug);

        if (! $document) {
            throw new NotFoundHttpException("Document `{$documentSlug}` not found");
        }

        list($formatId, $chapterId) = $this->getEntityIds(
            $document,
            $editionType,
            $formatType,
            $chapterSlug
        );

        $this->insert($formatId, $chapterId);
    }

    /**
     * Insert the download log row
     *
     * @param string $formatId
     * @param ?string $chapterId
     * @return void
     */
    protected function insert(string $formatId, ?string $chapterId = null)
    {
        try {
            $this->db
                ->insert('downloads')
                ->setValue('id', '?')
                ->setValue('format_id', '?')
                ->setValue('chapter_id', '?')
                ->setValue('user_agent', '?')
                ->setValue('ip', '?')
                ->setParameter(0, (string) Uuid::generate(4))
                ->setParameter(1, $formatId)
                ->setParameter(2, $chapterId)
                ->setParameter(3, $_SERVER['HTTP_USER_AGENT'] ?? '')
                ->setParameter(4, $this->getIpAddress())
                ->execute();
        } catch (\Exception $e) {
            // ¯\_(ツ)_/¯
        }
    }

    /**
     * Get downloader IP address
     *
     * @return string
     */
    protected function getIpAddress(): string
    {
        if (! empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }

        if (! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        return $_SERVER['REMOTE_ADDR'] ?? '';
    }
}
