<?php

namespace Dream\Clients\Rubix;

use Dream\Clients\TextClient;
use Dream\Entities\Sentiment;
use Rubix\ML\Probabilistic;
use Rubix\ML\PersistentModel;
use Rubix\ML\Persisters\Filesystem;
use Rubix\ML\Datasets\Unlabeled;

class RubixTextClient extends TextClient
{
    protected Probabilistic $sentimentEstimator;

    protected string $text;

    public function __construct(string $text)
    {
        $this->text = $text;
        $this->sentimentEstimator = PersistentModel::load(
            new Filesystem(config('dream.connections.rubix.models.sentiment'))
        );
    }

    public function sentiment(string $language = null): Sentiment
    {
        $dataset = new Unlabeled([
            [$this->text],
        ]);
        $response = $this->sentimentEstimator->proba($dataset);

        return new Sentiment(
            positive: $response[0]['positive'],
            negative: $response[0]['negative'],
            neutral: 0.0
        );
    }
}
