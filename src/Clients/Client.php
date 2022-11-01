<?php

namespace Dream\Clients;

use Dream\Collections\TextEntityCollection;
use Dream\Enums\Language;
use Dream\Exceptions\DreamConnectionNotFound;
use Dream\Exceptions\DreamDriverMethodNotDefinedException;
use Dream\Exceptions\DreamDriverNotFound;
use Dream\Sentiment;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class Client
{
    /**
     * @param  string  $text
     * @param  string|null  $language
     * @return Sentiment
     *
     * @throws DreamDriverMethodNotDefinedException
     */
    public function sentiment(string $text, string $language = null): Sentiment
    {
        throw new DreamDriverMethodNotDefinedException();
    }

    /**
     * @param  string  $text
     * @param  string|null  $language
     * @return Collection
     *
     * @throws DreamDriverMethodNotDefinedException
     */
    public function keyPhrases(string $text, string $language = null): Collection
    {
        throw new DreamDriverMethodNotDefinedException();
    }

    /**
     * @param  string  $text
     * @param  string|null  $language
     * @return TextEntityCollection
     *
     * @throws DreamDriverMethodNotDefinedException
     */
    public function entities(string $text, string $language = null): TextEntityCollection
    {
        throw new DreamDriverMethodNotDefinedException();
    }

    /**
     * @param string $text
     * @return Language
     * @throws DreamDriverMethodNotDefinedException
     */
    public function language(string $text): Language
    {
        throw new DreamDriverMethodNotDefinedException();
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
