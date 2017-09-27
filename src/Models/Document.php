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
     * @var array<Edition>
     */
    protected $editions = [];

    /**
     * @var array<Tag>
     */
    protected $tags = [];

    /**
     * @var Friend
     */
    protected $friend;

    /**
     * Get all unique format types
     *
     * @return array
     */
    public function getUniqueFormatTypes(): array
    {
        $formatTypes = [];
        foreach ($this->getEditions() as $edition) {
            foreach ($edition->getFormats() as $format) {
                $formatTypes[] = $format->getType();
            }
        }

        return array_unique($formatTypes);
    }

    /**
     * Does the document have a modernized edition?
     *
     * @return bool
     */
    public function hasModernizedEdition(): bool
    {
        foreach ($this->getEditions() as $edition) {
            if ($edition->getType() === 'modernized') {
                return true;
            }
        }

        return false;
    }

    /**
     * Does the document have audio available for any of it's editions?
     *
     * @return bool
     */
    public function hasAudio(): bool
    {
        return in_array('audio', $this->getUniqueFormatTypes());
    }

    /**
     * Get shortest edition by pages
     *
     * @return Edition
     */
    public function getShortestEdition(): Edition
    {
        $editions = $this->getEditions();
        return array_reduce($editions, function (?Edition $carry, Edition $edition) {
            if (! $carry) {
                return $edition;
            }

            return $edition->getPages() < $carry->getPages() ? $edition : $carry;
        });
    }

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

    /**
     * Set tags
     *
     * @param array<Tag> $tags
     */
    public function setTags(array $tags): void
    {
        $this->tags = [];
        foreach ($tags as $tag) {
            $this->addTag($tag);
        }
    }

    /**
     * Add a tag
     *
     * @param Tag $tag
     */
    public function addTag(Tag $tag): void
    {
        $this->tags[] = $tag;
    }

    /**
     * Get tags
     *
     * @return array<Tag>
     */
    public function getTags(): array
    {
        return $this->tags;
    }
}
