<?php

namespace Evans\Models;

use Evans\Models\Traits\HasSlug;
use Evans\Models\Traits\HasName;
use Evans\Models\Traits\HasDescription;

class Friend extends Entity
{
    use HasName;
    use HasSlug;
    use HasDescription;

    /**
     * @var array<Document>
     */
    protected $documents = [];

    /**
     * Set documents
     *
     * @param array<Document> $documents
     */
    public function setDocuments(array $documents): void
    {
        $this->documents = [];
        foreach ($documents as $document) {
            $this->addDocument($document);
        }
    }

    /**
     * Add a document
     *
     * @param Document $document
     */
    public function addDocument(Document $document): void
    {
        $this->documents[] = $document;
    }

    /**
     * Get documents
     *
     * @return array<Document>
     */
    public function getDocuments(): array
    {
        return $this->documents;
    }
}
