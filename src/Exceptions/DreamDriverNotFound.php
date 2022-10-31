<?php

namespace Dream\Exceptions;

use Exception;

class DreamDriverNotFound extends Exception
{
    public function __construct(string $driver)
    {
        parent::__construct("The driver [{$driver}] was not found in the dream config file.");
    }
}
