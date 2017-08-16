<?php

namespace Evans\Models;

use Evans\Models\Traits\HasSlug;
use Evans\Models\Traits\HasTitle;
use Evans\Models\Traits\HasDescription;

class Document extends Entity
{
    use HasSlug;
    use HasTitle;
    use HasDescription;

    /**
     * @var array<Chapter>
     */
    protected $chapters = [];

    /**
     * @var array<Edition>
     */
    protected $editions = [];

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

    /**
     * Set chapters
     *
     * @param array<Chapter> $chapters
     */
    public function setChapters(array $chapters): void
    {
        $this->chapters = [];
        foreach ($chapters as $document) {
            $this->addChapter($document);
        }
    }

    /**
     * Add a document
     *
     * @param Chapter $document
     */
    public function addChapter(Chapter $document): void
    {
        $this->chapters[] = $document;
    }

    /**
     * Get chapters
     *
     * @return array<Chapter>
     */
    public function getChapters(): array
    {
        return $this->chapters;
    }

    /**
     * Set editions
     *
     * @param array<Edition> $editions
     */
    public function setEditions(array $editions): void
    {
        $this->editions = [];
        foreach ($editions as $edition) {
            $this->addEdition($edition);
        }
    }

    /**
     * Add a edition
     *
     * @param Edition $edition
     */
    public function addEdition(Edition $edition): void
    {
        $this->editions[] = $edition;
    }

    /**
     * Get editions
     *
     * @return array<Edition>
     */
    public function getEditions(): array
    {
        return $this->editions;
    }
}
