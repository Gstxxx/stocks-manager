<?php

namespace App\Clients\BrazaApi;

use Illuminate\Support\Facades\Http;

class BrazaApiClient
{

    /**
     * @param string $quote
     * @return QuoteEntity[]
     * @throws \Exception
     */
    public function findQuote(string $quote): array
    {

        $token = config('services.br_api.key');

        $uri = sprintf("https://brapi.dev/api/quote/%s?token=%s", $quote, $token);

        $response = Http::get($uri)->json();

        if (isset($response['error'])) {
            throw BrazaApiException::quoteNotFound($quote);
        }

        return collect($response['results'])
            ->map(fn(array $quote) => QuoteEntity::new($quote))
            ->all();
    }
}
