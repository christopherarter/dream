<?php

namespace Dream\Clients\Aws;

use Aws\Rekognition\RekognitionClient;
use Dream\Clients\ImageClient;
use Dream\Collections\TextCollection;
use Dream\Entities\Text;
use Illuminate\Support\Arr;

class AwsImageClient extends ImageClient
{
    protected RekognitionClient $rekognitionClient;

    protected string $image;

    public function __construct(string $image)
    {
        $this->image = $image;

        $this->rekognitionClient = app(RekognitionClient::class, ['args' => [
            'region' => config('dream.connections.aws.region'),
            'version' => 'latest',
        ]]);
    }

    public function labels(): TextCollection
    {
        $response = $this->rekognitionClient->detectLabels([
            'Image' => [
                'Bytes' => $this->image,
            ],
        ]);

        return new TextCollection(collect(Arr::get($response, 'Labels'))
            ->map(function ($label) {
                return new Text(
                    text: Arr::get($label, 'Name'),
                    score: Arr::get($label, 'Confidence'),
                );
            }));
    }

    public function text(): TextCollection
    {
        $response = $this->rekognitionClient->detectText([
            'Image' => [
                'Bytes' => $this->image,
            ],
        ]);

        return new TextCollection(collect(Arr::get($response, 'TextDetections'))
            ->map(function ($detection) {
                return new Text(
                    text: Arr::get($detection, 'DetectedText'),
                    score: Arr::get($detection, 'Confidence'),
                );
            }));
    }
}
