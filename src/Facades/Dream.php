<?php

namespace Dream\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static Dream\Clients sentiment(string $string, $language = null)
 * @method static Dream\Clients keyPhrases(string $string, $language = null)
 * @method static Dream\Clients entities(string $string, $language = null)
 * @method static Dream\Clients connection(string $string)
 */
class Dream extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'dream';
    }
}
