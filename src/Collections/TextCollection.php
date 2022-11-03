<?php

namespace Dream\Collections;

use Dream\Entities\Sentiment;
use Dream\Entities\Text;
use Illuminate\Support\Collection;

class TextCollection extends Collection
{
    public function text(): string
    {
        return $this->map(function (Text $imageText) {
            return $imageText->text;
        })->implode(' ');
    }

    public function sentiment(): Sentiment
    {
        return app('dream')->text($this->text())->sentiment();
    }

    public function phrases(): TextCollection
    {
        return app('dream')->text($this->text())->phrases();
    }

    public function entities(): TextEntityCollection
    {
        return app('dream')->text($this->text())->entities();
    }
}
