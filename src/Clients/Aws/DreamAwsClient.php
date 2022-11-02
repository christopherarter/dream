<?php

namespace Dream\Clients\Aws;

use Aws\Comprehend\ComprehendClient;
use Aws\Rekognition\RekognitionClient;
use Dream\Clients\Client;
use Dream\Collections\ImageTextCollection;
use Dream\Collections\TextEntityCollection;
use Dream\Enums\Language;
use Dream\Enums\TextEntityType;
use Dream\ImageLabel;
use Dream\ImageText;
use Dream\KeyPhrase;
use Dream\Sentiment;
use Dream\TextEntity;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class DreamAwsClient extends Client
{
    public function __construct(protected ComprehendClient $comprehendClient, protected RekognitionClient $rekognitionClient)
    {
    }

    public function sentiment(string $text, string $language = null): Sentiment
    {
        $response = $this->comprehendClient->detectSentiment([
            'LanguageCode' => $language ?? config('dream.default_language'),
            'Text' => $text,
        ]);

        return new Sentiment(
            positive: Arr::get($response, 'SentimentScore.Positive'),
            negative: Arr::get($response, 'SentimentScore.Negative'),
            neutral: Arr::get($response, 'SentimentScore.Neutral')
        );
    }

    public function keyPhrases(string $text, string $language = null): Collection
    {
        $response = $this->comprehendClient->detectKeyPhrases([
            'LanguageCode' => $language ?? config('dream.default_language'),
            'Text' => $text,
        ]);

        return collect(Arr::get($response, 'KeyPhrases'))->map(function ($keyPhrase) {
            return new KeyPhrase(
                text: Arr::get($keyPhrase, 'Text'),
                score: Arr::get($keyPhrase, 'Score')
            );
        });
    }

    public function entities(string $text, string $language = null): TextEntityCollection
    {
        $response = $this->comprehendClient->detectEntities([
            'LanguageCode' => $language ?? config('dream.default_language'),
            'Text' => $text,
        ]);

        $entities = collect(Arr::get($response, 'Entities'))
            ->map(function ($entity) {
                return new TextEntity(
                    text: Arr::get($entity, 'Text'),
                    type: TextEntityType::from(Arr::get($entity, 'Type')),
                    score: Arr::get($entity, 'Score')
                );
            });

        return new TextEntityCollection($entities);
    }

    public function language(string $text): Language
    {
        $response = $this->comprehendClient->detectDominantLanguage([
            'Text' => $text,
        ]);
        $language = Arr::get($response, 'Languages.0.LanguageCode');

        return Language::from($language);
    }

    public function imageText(string $image): ImageTextCollection
    {
        $response = $this->rekognitionClient->detectText([
            'Image' => [
                'Bytes' => $image,
            ],
        ]);

        return new ImageTextCollection(collect(Arr::get($response, 'TextDetections'))
            ->map(function ($detection) {
                return new ImageText(
                    text: Arr::get($detection, 'DetectedText'),
                    score: Arr::get($detection, 'Confidence'),
                );
            }));
    }

    public function imageLabels(string $image): Collection
    {
        $response = $this->rekognitionClient->detectLabels([
            'Image' => [
                'Bytes' => $image,
            ],
        ]);

        return collect(Arr::get($response, 'Labels'))
            ->map(function ($label) {
                return new ImageLabel(
                    name: Arr::get($label, 'Name'),
                    score: Arr::get($label, 'Confidence'),
                );
            });
    }
}
