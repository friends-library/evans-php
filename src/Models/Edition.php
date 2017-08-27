<?php

namespace Evans\Models;

use Evans\Models\Traits\HasType;
use Evans\Models\Traits\HasDocument;
use Evans\Models\Traits\HasDescription;

class Edition extends Entity
{
    use HasType;
    use HasDocument;
    use HasDescription;

    /**
     * @var array<Chapter>
     */
    protected $chapters = [];

    /**
     * @var array<Format>
     */
    protected $formats = [];

    /**
     * @var int
     */
    protected $pages;

    /**
     * @var int
     */
    protected $wordCount;

    /**
     * @var int
     */
    protected $seconds;

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
     * Set formats
     *
     * @param array<Format> $formats
     */
    public function setFormats(array $formats): void
    {
        $this->formats = [];
        foreach ($formats as $format) {
            $this->addFormat($format);
        }
    }

    /**
     * Add a format
     *
     * @param Format $format
     */
    public function addFormat(Format $format): void
    {
        $this->formats[] = $format;
    }

    /**
     * Get formats
     *
     * @return array<Format>
     */
    public function getFormats(): array
    {
        return $this->formats;
    }

    /**
     * Set pages
     *
     * @param int $pages
     */
    public function setPages(int $pages): void
    {
        $this->pages = $pages;
    }

    /**
     * Get pages
     *
     * @return int
     */
    public function getPages(): int
    {
        return $this->pages;
    }

    /**
     * Set word count
     *
     * @param int $wordCount
     */
    public function setWordCount(int $wordCount): void
    {
        $this->wordCount = $wordCount;
    }

    /**
     * Get word count
     *
     * @return int
     */
    public function getWordCount(): int
    {
        return $this->wordCount;
    }

    /**
     * Set seconds
     *
     * @param int $seconds
     */
    public function setSeconds(int $seconds): void
    {
        $this->seconds = $seconds;
    }

    /**
     * Get seconds
     *
     * @return int
     */
    public function getSeconds(): int
    {
        return $this->seconds;
    }
}
