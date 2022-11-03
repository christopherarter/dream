<?php

namespace Dream\Collections;

use Dream\Enums\TextEntityType;

class TextEntityCollection extends TextCollection
{
    protected function filterByType(TextEntityType $type): self
    {
        return $this->filter(fn ($entity) => $entity->type === $type);
    }

    public function places(): self
    {
        return $this->filterByType(TextEntityType::LOCATION);
    }

    public function events(): self
    {
        return $this->filterByType(TextEntityType::EVENT);
    }

    public function organizations(): self
    {
        return $this->filterByType(TextEntityType::ORGANIZATION);
    }

    public function people(): self
    {
        return $this->filterByType(TextEntityType::PERSON);
    }

    public function titles(): self
    {
        return $this->filterByType(TextEntityType::TITLE);
    }

    public function quantities(): self
    {
        return $this->filterByType(TextEntityType::QUANTITY);
    }

    public function products(): self
    {
        return $this->filterByType(TextEntityType::COMMERCIAL_ITEM);
    }
}
