<?php

namespace App\Services;

use App\Clients\BrazaApi\BrazaApiClient;
use App\Models\Stock;

class QuoteService
{
    public function __construct(private readonly BrazaApiClient $brazaClient)
    {
    }

    public function create(array $payload): void
    {
        $quotes = $this->brazaClient->findQuote($payload['search-bar-quote']);

        foreach ($quotes as $quote) {
            Stock::updateOrCreate(['symbol' => $quote->symbol], [
                ...$quote->toDatabase(),
                'amount' => $payload['amount-quote'],
                'paid' => $payload['paid-quote'],
            ]);
        }
    }
}
