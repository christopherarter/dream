<?php

namespace Dream\Entities;

class Text
{
    public function __construct(
        public string $text,
        public float $score,
    ) {
    }
}
