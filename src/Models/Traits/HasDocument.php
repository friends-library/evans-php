<?php

namespace Evans\Models\Traits;

trait HasDocument
{
    /**
     * @var Document
     */
    protected $document;

    /**
     * Set the model's document
     *
     * @param Document $document
     */
    public function setDocument(Document $document): void
    {
        $this->document = $document;
    }

    /**
     * Get the model's document
     *
     * @return Document
     */
    public function getDocument(): Document
    {
        return $this->document;
    }
}
