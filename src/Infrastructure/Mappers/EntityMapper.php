<?php

namespace Evans\Infrastructure\Mappers;

use Evans\Models\Entity;
use Cake\Chronos\Chronos;

abstract class EntityMapper
{
    /**
     * @var string
     */
    protected $class;

    /**
     * Map db result to entity
     *
     * @param array $result
     * @return Entity
     */
    protected function mapEntity(array $result): Entity
    {
        $parts = explode('\\', $this->class);
        $slug = strtolower(end($parts));
        $entity = new $this->class();
        $entity->setId($result["{$slug}_id"]);
        $this->setTimestamps($entity, $result, $slug);

        if (method_exists($entity, 'setName')) {
            $entity->setName($result["{$slug}_name"]);
        }

        if (method_exists($entity, 'setTitle')) {
            $entity->setTitle($result["{$slug}_title"]);
        }

        if (method_exists($entity, 'setDescription')) {
            $description = $result["{$slug}_description"] ?? '';
            $entity->setDescription($description);
        }

        if (method_exists($entity, 'setSlug')) {
            $entity->setSlug($result["{$slug}_slug"]);
        }

        if (method_exists($entity, 'setType')) {
            $entity->setType($result["{$slug}_type"]);
        }

        return $entity;
    }

    /**
     * Map entity timestamps
     *
     * @param Entity $entity
     * @param array $result
     * @param string $slug
     */
    protected function setTimestamps(Entity $entity, array $result, string $slug): void
    {
        $format = 'Y-m-d H:i:s';
        $created = Chronos::createFromFormat($format, $result["{$slug}_created_at"]);
        $entity->setCreatedAt($created);
        $updated = Chronos::createFromFormat($format, $result["{$slug}_updated_at"]);
        $entity->setUpdatedAt($updated);
    }
}
