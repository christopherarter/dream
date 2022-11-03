<?php

namespace Dream\Tests\Fixtures;

use Dream\Clients\ImageClient;
use Dream\Collections\TextCollection;
use Dream\Entities\Text;

class TestImageClient extends ImageClient
{
    public function text(): TextCollection
    {
        return new TextCollection([
            new Text('Some text in an image', 0.99),
            new Text('More text in an image.', 0.98),
        ]);
    }

    public function labels(): TextCollection
    {
        return new TextCollection([
            new Text('a desc of the image', 0.99),
            new Text('another desc of the image', 0.98),
        ]);
    }
}
