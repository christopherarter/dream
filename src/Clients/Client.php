<?php

namespace Dream\Clients;

use Dream\Exceptions\DreamConnectionNotFound;
use Dream\Exceptions\DreamDriverNotFound;
use Illuminate\Support\Arr;

class Client
{
    /**
     * Returns an image client to do image related tasks.
     *
     * @param  string  $image
     * @return ImageClient
     */
    public function image(string $image): ImageClient
    {
        return new ImageClient($image);
    }

    /**
     * Returns a text client to do text related tasks.
     *
     * @param  string  $text
     * @return TextClient
     */
    public function text(string $text): TextClient
    {
        return new TextClient($text);
    }

    /**
     * @param  string  $connection
     * @return Client
     *
     * @throws DreamConnectionNotFound
     * @throws DreamDriverNotFound
     */
    public static function connection(string $connection): Client
    {
        $connectionConfig = Arr::get(config('dream.connections'), $connection);

        if (! $connectionConfig) {
            throw new DreamConnectionNotFound($connection);
        }

        $driver = Arr::get($connectionConfig, 'driver');

        if (! $driver || ! class_exists($driver)) {
            throw new DreamDriverNotFound($connection);
        }

        return app($driver);
    }
}
