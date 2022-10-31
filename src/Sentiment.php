<?php

namespace Dream;

class Sentiment
{
    public function __construct(public $positive, public $negative, public $neutral)
    {
    }

    /**
     * Determine if the sentiment is positive, negative or neutral.
     *
     * @return string
     */
    public function disposition(): string
    {
        $highestNumber = max($this->positive, $this->negative, $this->neutral);

        if ($highestNumber === $this->positive) {
            return 'positive';
        }
        if ($highestNumber === $this->negative) {
            return 'negative';
        }

        return 'neutral';
    }

    /**
     * Determine if the sentiment is positive.
     *
     * @return bool
     */
    public function positive(): bool
    {
        return $this->disposition() === 'positive';
    }

    /**
     * Determine if the sentiment is negative.
     *
     * @return bool
     */
    public function negative(): bool
    {
        return $this->disposition() === 'negative';
    }

    /**
     * @return bool
     */
    public function neutral(): bool
    {
        return $this->disposition() === 'neutral';
    }
}
