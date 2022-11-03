<?php

namespace Dream\Clients;

use Dream\Collections\TextCollection;
use Dream\Exceptions\DreamDriverMethodNotDefinedException;

class ImageClient
{
    public function __construct(protected string $image)
    {
    }

    /**
     * Gets the text from an image as a collection of ImageText objects.
     *
     * @return TextCollection
     *
     * @throws DreamDriverMethodNotDefinedException
     */
    public function text(): TextCollection
    {
        throw new DreamDriverMethodNotDefinedException();
    }

    /**
     * Gets the labels from an image as a collection of ImageLabel objects.
     *
     * @return TextCollection
     *
     * @throws DreamDriverMethodNotDefinedException
     */
    public function labels(): TextCollection
    {
        throw new DreamDriverMethodNotDefinedException();
    }
}
