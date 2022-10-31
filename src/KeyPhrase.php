<?php

namespace Dream;

class KeyPhrase
{
    public function __construct(public string $text, public float $score)
    {
    }
}
