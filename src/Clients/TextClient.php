<?php

namespace Dream\Clients;

use Dream\Collections\TextCollection;
use Dream\Collections\TextEntityCollection;
use Dream\Entities\Sentiment;
use Dream\Enums\Language;
use Dream\Exceptions\DreamDriverMethodNotDefinedException;

class TextClient
{
    public function __construct(protected string $text)
    {
    }

    /**
     * Gets the sentiment of the text.
     *
     * @return Sentiment
     *
     * @throws DreamDriverMethodNotDefinedException
     */
    public function sentiment(): Sentiment
    {
        throw new DreamDriverMethodNotDefinedException();
    }

    /**
     * Determines the language of the text.
     *
     * @return Language
     *
     * @throws DreamDriverMethodNotDefinedException
     */
    public function language(): Language
    {
        throw new DreamDriverMethodNotDefinedException();
    }

    /**
     * Determines what entities are in the text.
     *
     * @return TextEntityCollection
     *
     * @throws DreamDriverMethodNotDefinedException
     */
    public function entities(): TextEntityCollection
    {
        throw new DreamDriverMethodNotDefinedException();
    }

    /**
     * Determines key phrases in the text.
     *
     * @return TextCollection
     *
     * @throws DreamDriverMethodNotDefinedException
     */
    public function phrases(): TextCollection
    {
        throw new DreamDriverMethodNotDefinedException();
    }

    /**
     * @param  int  $maxTokens
     * @param  float  $temperature
     * @param  string  $model
     * @return string
     *
     * @throws DreamDriverMethodNotDefinedException
     */
    public function prompt(int $maxTokens = 20, float $temperature = 0.5, string $model = ''): string
    {
        throw new DreamDriverMethodNotDefinedException();
    }
}
