<?php

namespace Dream;

use Dream\Enums\TextEntityType;

class TextEntity
{
    public function __construct(public string $text, public TextEntityType $type, public float $score)
    {
    }
}
