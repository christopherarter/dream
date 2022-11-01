<?php

namespace Dream\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static Dream\Clients sentiment(string $string, $language = null): Dream\Sentiment
 * @method static Dream\Clients keyPhrases(string $string, $language = null): \Illuminate\Support\Collection
 * @method static Dream\Clients entities(string $string, $language = null): Dream\Collections\TextEntityCollection
 * @method static Dream\Clients connection(string $string): Dream\Clients\Client
 * @method static Dream\Clients language(string $string): Dream\Enums\Language
 */
class Dream extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'dream';
    }
}
