<?php

namespace Dream\Exceptions;

use Exception;

/**
 * Class DreamDriverMethodNotDefinedException
 * This exception is thrown when a method is not defined in the driver
 * child class. This is to notify the developer that the method is not
 * available in that particular driver.
 */
class DreamDriverMethodNotDefinedException extends Exception
{
    public function __construct()
    {
        parent::__construct('This method has not been defined by the selected Dream driver.');
    }
}
