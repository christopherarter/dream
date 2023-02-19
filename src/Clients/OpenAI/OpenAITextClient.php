<?php

namespace Dream\Clients\OpenAI;

use Dream\Clients\TextClient;
use Dream\Collections\TextCollection;
use Dream\Collections\TextEntityCollection;
use Dream\Entities\Sentiment;
use Dream\Entities\TextEntity;
use Dream\Enums\Language;
use Dream\Enums\TextEntityType;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class OpenAITextClient extends TextClient
{
    protected string $endpoint = 'https://api.openai.com/v1';

    protected function client(): PendingRequest
    {
        return Http::withHeaders([
            'Authorization' => 'Bearer '.config('dream.connections.openai.key'),
            'Content-Type' => 'application/json',
        ]);
    }

    public function prompt(int $maxTokens = 20, float $temperature = 0.5, string $model = 'text-davinci-003'): string
    {
        $response = $this->client()->post($this->endpoint.'/completions', [
            'prompt' => $this->text,
            'max_tokens' => $maxTokens,
            'temperature' => $temperature,
            'model' => $model,
        ])->json();

        return Arr::get($response, 'choices.0.text');
    }

    public function sentiment(): Sentiment
    {
        $this->text = Str::of($this->text)
            ->prepend('return 3 sentiment scores in lowercase for the following text on a scale of 0 to 1, the scores are positive, negative, and neutral. label them and separate by a comma: \n ');

        $scores = Str::of($this->prompt())
            ->trim()
            ->explode(',')
            ->map(fn ($score) => preg_replace('/.*: /', '', $score))
            ->toArray();

        return new Sentiment(
            positive: (float) Arr::get($scores, 0, 0),
            negative: (float) Arr::get($scores, 1, 0),
            neutral: (float) Arr::get($scores, 2, 0),
        );
    }

    public function language(): Language
    {
        $this->text = Str::of($this->text)
            ->prepend('return only the language code for the language detected in the following text: ');

        $response = Str::of($this->prompt())->trim();

        return Language::tryFrom($response);
    }

    public function entities(): TextEntityCollection
    {
        $types = implode(', ', array_column(TextEntityType::cases(), 'value'));

        $this->text = Str::of($this->text)
            ->prepend("detect entities in the following text and classify them as either {$types}. return the results as json and make sure each item has an entity, classification and score key. the score key is how confident classification is: ");

        $response = json_decode($this->prompt(200), true);

        return new TextEntityCollection(collect($response)->map(function ($item) {
            return new TextEntity(
                text: Arr::get($item, 'entity'),
                score: (float) Arr::get($item, 'score'),
                type: TextEntityType::tryFrom(Arr::get($item, 'classification')));
        }));
    }

    public function phrases(): TextCollection
    {
        $this->text = Str::of($this->text)
            ->prepend('return only the key phrases in the following text as a json array: ');

        $response = Str::of($this->prompt())
            ->trim()
            ->toString();

        $phrases = json_decode($response, true);

        return new TextCollection($phrases);
    }
}
