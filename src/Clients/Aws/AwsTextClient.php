<?php

namespace Dream\Clients\Aws;

use Aws\Comprehend\ComprehendClient;
use Dream\Clients\TextClient;
use Dream\Collections\TextCollection;
use Dream\Collections\TextEntityCollection;
use Dream\Entities\Sentiment;
use Dream\Entities\Text;
use Dream\Entities\TextEntity;
use Dream\Enums\Language;
use Dream\Enums\TextEntityType;
use Illuminate\Support\Arr;

class AwsTextClient extends TextClient
{
    protected ComprehendClient $comprehendClient;

    protected string $text;

    public function __construct(string $text)
    {
        $this->text = $text;

        $this->comprehendClient = app(ComprehendClient::class, ['args' => [
            'region' => config('dream.connections.aws.region'),
            'version' => 'latest',
        ]]);
    }

    public function phrases(string $language = null): TextCollection
    {
        $response = $this->comprehendClient->detectKeyPhrases([
            'LanguageCode' => $language ?? config('dream.default_language'),
            'Text' => $this->text,
        ]);

        return new TextCollection(
            collect(Arr::get($response, 'KeyPhrases'))->map(function ($keyPhrase) {
                return new Text(
                    text: Arr::get($keyPhrase, 'Text'),
                    score: Arr::get($keyPhrase, 'Score')
                );
            })
        );
    }

    public function language(): Language
    {
        $response = $this->comprehendClient->detectDominantLanguage([
            'Text' => $this->text,
        ]);

        return Language::from(Arr::get($response, 'Languages.0.LanguageCode'));
    }

    public function entities(string $language = null): TextEntityCollection
    {
        $response = $this->comprehendClient->detectEntities([
            'LanguageCode' => $language ?? config('dream.default_language'),
            'Text' => $this->text,
        ]);

        return new TextEntityCollection(
            collect(Arr::get($response, 'Entities'))
            ->map(function ($entity) {
                return new TextEntity(
                    text: Arr::get($entity, 'Text'),
                    score: Arr::get($entity, 'Score'),
                    type: TextEntityType::from(Arr::get($entity, 'Type'))
                );
            })
        );
    }

    public function sentiment(string $language = null): Sentiment
    {
        $response = $this->comprehendClient->detectSentiment([
            'LanguageCode' => $language ?? config('dream.default_language'),
            'Text' => $this->text,
        ]);

        return new Sentiment(
            positive: Arr::get($response, 'SentimentScore.Positive'),
            negative: Arr::get($response, 'SentimentScore.Negative'),
            neutral: Arr::get($response, 'SentimentScore.Neutral')
        );
    }
}
