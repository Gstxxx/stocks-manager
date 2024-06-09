<?php

namespace App\Clients\BrazaApi;

readonly class QuoteEntity
{
    public function __construct(
        public string $currency,
        public string $shortName,
        public string $longName,
        public float  $regularMarketChange,
        public float  $regularMarketChangePercent,
        public string $regularMarketTime,
        public float  $regularMarketPrice,
        public float  $regularMarketDayHigh,
        public string $regularMarketDayRange,
        public float  $regularMarketDayLow,
        public int    $regularMarketVolume,
        public float  $regularMarketPreviousClose,
        public float  $regularMarketOpen,
        public string $fiftyTwoWeekRange,
        public float  $fiftyTwoWeekLow,
        public float  $fiftyTwoWeekHigh,
        public string $symbol,
        public ?float $priceEarnings,
        public ?float $earningsPerShare,
        public string $logoUrl
    )
    {
    }

    public static function new(array $payload): self
    {
        return new self(
            currency: $payload['currency'],
            shortName: $payload['shortName'],
            longName: $payload['longName'],
            regularMarketChange: $payload['regularMarketChange'],
            regularMarketChangePercent: $payload['regularMarketChangePercent'],
            regularMarketTime: $payload['regularMarketTime'],
            regularMarketPrice: $payload['regularMarketPrice'],
            regularMarketDayHigh: $payload['regularMarketDayHigh'],
            regularMarketDayRange: $payload['regularMarketDayRange'],
            regularMarketDayLow: $payload['regularMarketDayLow'],
            regularMarketVolume: $payload['regularMarketVolume'],
            regularMarketPreviousClose: $payload['regularMarketPreviousClose'],
            regularMarketOpen: $payload['regularMarketOpen'],
            fiftyTwoWeekRange: $payload['fiftyTwoWeekRange'],
            fiftyTwoWeekLow: $payload['fiftyTwoWeekLow'],
            fiftyTwoWeekHigh: $payload['fiftyTwoWeekHigh'],
            symbol: $payload['symbol'],
            priceEarnings: $payload['priceEarnings'],
            earningsPerShare: $payload['earningsPerShare'],
            logoUrl: $payload['logourl'],
        );
    }

    public function toDatabase(): array
    {
        return [
            'longName' => $this->longName,
            'logourl' => $this->logoUrl,
            'regularMarketChange' => $this->regularMarketChange,
            'regularMarketChangePercent' => $this->regularMarketChangePercent,
            'regularMarketTime' => $this->regularMarketTime,
            'regularMarketPrice' => $this->regularMarketPrice,
            'regularMarketPreviousClose' => $this->regularMarketPreviousClose,
            'regularMarketOpen' => $this->regularMarketOpen,
        ];
    }
}
