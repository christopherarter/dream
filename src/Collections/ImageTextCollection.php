<?php

namespace Dream\Collections;

use Dream\ImageText;
use Dream\Sentiment;
use Illuminate\Support\Collection;

class ImageTextCollection extends Collection
{
    public function text(): string
    {
        return $this->map(function (ImageText $imageText) {
            return $imageText->text;
        })->implode(' ');
    }

    public function sentiment(): Sentiment
    {
        return app('dream')->sentiment($this->text());
    }

    public function keyPhrases(): Collection
    {
        return app('dream')->keyPhrases($this->text());
    }

    public function entities(): TextEntityCollection
    {
        return app('dream')->entities($this->text());
    }
}
