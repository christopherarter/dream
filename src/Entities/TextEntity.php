<?php

namespace Dream\Entities;

use Dream\Enums\TextEntityType;

class TextEntity extends Text
{
    public TextEntityType $type;

    public function __construct(string $text, float $score, TextEntityType $type)
    {
        parent::__construct($text, $score);
        $this->type = $type;
    }
}
