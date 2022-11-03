<?php

namespace Dream\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static Dream\Clients\Client connection(string $string)
 * @method static Dream\Clients\ImageClient image(string $image)
 * @method static Dream\Clients\TextClient text(string $text)
 */
class Dream extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'dream';
    }
}
