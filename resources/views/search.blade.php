<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stocks Manager</title>
    @vite('resources/css/app.css')
</head>

<body>

    <body class="bg-zinc-950 flex flex-col items-center justify-center min-h-screen ">
        <div class="flex flex-row space-x-10 mb-10 mt-10">
            <div class="bg-zinc-900 p-6 rounded-lg shadow-lg">
                <form action="{{ route('storeQuote') }}" method="POST" class="flex flex-col py-2 space-y-3">
                    @csrf
                    <p class="text-white">Nome</p>
                    <input type="text" id="search-bar-quote" name="search-bar-quote" placeholder="KLBN11"
                        class="text-gray-300 bg-zinc-800 
                        border
                         border-gray-400
                          rounded-md p-2 focus:outline-none focus:border-purple-400 focus:text-white" />
                    <p class="text-white">Quantidade</p>
                    <input type="number" id="amount-quote" name="amount-quote" placeholder="0"
                        class="text-white bg-zinc-800 border border-gray-400 rounded-md p-2 focus:outline-nonefocus:text-white focus:border-purple-400" />

                    <p class="text-white">Valor Pago</p>
                    <input type="number" step="0.01" id="paid-quote" name="paid-quote" placeholder="R$ 0"
                        class="text-white bg-zinc-800 border border-gray-400 rounded-md p-2 focus:outline-none focus:text-white focus:border-purple-400" />

                    <button type="submit" id="add-bt"
                        class="px-4 py-2 bg-purple-500 text-white rounded-md hover:bg-purple-600 focus:outline-none focus:bg-purple-600">Add</button>
                    <button type="submit" id="remove-bt" formaction="/removeQuote"
                        class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600">Remove</button>
                </form>
            </div>
            @if ($stock)
                <div class="bg-zinc-900 p-6 rounded-lg shadow-lg" id="content">
                    <h1 class="text-white text-3xl font-black text-center">Ações</h1>
                    <table class="text-white p-4 border-separate">
                        <tr class="text-white">
                            <th class="px-4 font-black">Symbol</th>
                            <th class="px-4 font-black">Amount</th>
                            <th class="px-4 font-black">Paid</th>
                            <th class="px-4 font-black">Price</th>
                            <th class="px-4 font-black">Lucro</th>
                        </tr>
                        @foreach ($stock->sortByDesc('amount') as $result)
                            <tr class="text-gray-400">
                                <td class="px-4 font-bold">{{ $result['symbol'] }}</td>
                                <td class="px-4 text-right">{{ $result['amount'] }}</td>
                                <td class="px-4 text-right flex justify-between tabular-nums space-x-2">
                                    <span>R$</span>
                                    <span>{{ number_format($result['paid'], 2) }}</span>
                                </td>
                                <td class="px-4 text-right tabular-nums space-x-2 justify-between "><span>R$</span>
                                    <span>{{ number_format($result['regularMarketPrice'], 2) }}</span>
                                </td>

                                @php
                                    $precoAtual = intval($result['regularMarketPrice']);
                                    $lucro = $precoAtual - $result['paid'];
                                    $displayPlus = $lucro > 0 ? '+' : '';
                                    $changeColor = $lucro < 0 ? 'red' : 'green';
                                @endphp
                                <td class="px-4 tabular-nums"><span style="color: {{ $changeColor }}">R$
                                        {{ $displayPlus }}{{ number_format($lucro, 2) }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @endif
        </div>
        <div id="content" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 pb-8">
            @if ($stock)
                @foreach ($stock as $result)
                    <div
                        class="bg-zinc-900 p-4 rounded-lg shadow-md text-white max-w-96 flex flex-col h-100 justify-between">
                        <div class="flex justify-between">
                            <div class="flex justify-between space-x-4">
                                <img class="rounded-lg max-w-16 max-h-16" src="{{ $result['logourl'] }}"
                                    alt="Company Logo">
                                <div class="flex-col">

                                    @php
                                        $changePercent = $result['regularMarketChangePercent'];
                                        $changeColor = $changePercent < 0 ? 'red' : 'green';
                                    @endphp
                                    <h1 class="text-xl font-semibold ">{{ $result['symbol'] }}</h1>
                                    <p class="text-l font-black">R$ {{ $result['regularMarketPrice'] }}
                                        (<span style="color: {{ $changeColor }}">{{ $changePercent }}%</span>)
                                    <h2 class="text-sm text-gray-400">{{ $result['longName'] }}</h2>
                                </div>
                            </div>
                            <div class="text-right text-sm text-gray-500">
                                @php
                                    $date = new DateTime($result['regularMarketTime']);
                                    $formattedDate = $date->format('Y/m/d');
                                    $formattedDate2 = $date->format('H:i');
                                @endphp
                                <p>{{ $formattedDate }}</p>
                                <p>{{ $formattedDate2 }}</p>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-between ">
                            <div>
                                <h2 class="text-xl font-semibold">Abertura</h2>
                                <p>R$ {{ number_format($result['regularMarketOpen'], 2) }}
                                </p>
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold">Anterior</h2>
                                <p>R$ {{ number_format($result['regularMarketPreviousClose'], 2) }}
                                </p>
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold">Variação</h2>
                                @php
                                    $anterior = number_format($result['regularMarketPreviousClose'], 2);
                                    $abertura = number_format($result['regularMarketOpen'], 2);
                                    $atual = number_format($result['regularMarketPrice'], 2);
                                    $valor = number_format($anterior - $abertura, 2);
                                    $changeColor2 = $valor < 0 ? 'red' : 'green';
                                    $displayPlus2 = $valor > 0 ? '+' : '';
                                @endphp
                                <p>R$ <span style="color: {{ $changeColor2 }}">{{ $displayPlus2 }}
                                        {{ $valor }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </body>

</body>

</html>
