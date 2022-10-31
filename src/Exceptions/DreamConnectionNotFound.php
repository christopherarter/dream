<?php

namespace Dream\Exceptions;

use Exception;

/**
 * Class DreamDriverMethodNotDefinedException
 * This exception is thrown when a method is not defined in the driver
 * child class. This is to notify the developer that the method is not
 * available in that particular driver.
 */
class DreamConnectionNotFound extends Exception
{
    public function __construct(string $connection)
    {
        parent::__construct("The connection [{$connection}] was not found in the dream config file.");
    }
}
