<?php

namespace Dream\Clients\Aws;

use Aws\Comprehend\ComprehendClient;
use Dream\Clients\Client;
use Dream\Collections\TextEntityCollection;
use Dream\Enums\TextEntityType;
use Dream\KeyPhrase;
use Dream\Sentiment;
use Dream\TextEntity;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class DreamAwsClient extends Client
{
    public function __construct(protected ComprehendClient $comprehendClient)
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
}
