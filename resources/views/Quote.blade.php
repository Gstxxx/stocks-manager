<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stocks Manager</title>
</head>

<body>

    <div id="content">
        @foreach ($data['results'] as $result)
            <div>
                <div>
                    <h1>
                        <p>{{ $result['symbol'] }}</p>
                    </h1>
                    <h2>
                        <p>{{ $result['longName'] }}</p>
                    </h2>
                    <img src="{{ $result['logourl'] }}" alt="Company Logo">
                </div>
                <h2>Variação (dia)</h2>
                <p>R$ {{ $result['regularMarketChange'] }} ({{ $result['regularMarketChangePercent'] }}%)</p>
                <h2>Ultima Atualização</h2>
                <p>{{ $result['regularMarketTime'] }}</p>
                <h2>Preço</h2>
                <p>R$ {{ $result['regularMarketPrice'] }}</p>
                <h2>Fechamento anterior</h2>
                <p>R$ {{ $result['regularMarketPreviousClose'] }}</p>
                <h2>Abertura</h2>
                <p>R$ {{ $result['regularMarketOpen'] }}</p>
            </div>
        @endforeach
    </div>

</body>

</html>
