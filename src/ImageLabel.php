<?php

namespace Dream;

class ImageLabel
{
    public function __construct(
        public string $name,
        public float $score,
    ) {
    }
}
