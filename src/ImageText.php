<?php

namespace Dream;

class ImageText
{
    public function __construct(
        public string $text,
        public float $score,
    ) {
    }
}
