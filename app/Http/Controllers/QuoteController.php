<?php

namespace App\Http\Controllers;

use App\Clients\BrazaApi\BrazaApiClient;
use App\Clients\BrazaApi\BrazaApiException;
use App\Http\Requests\StoreQuoteRequest;
use App\Models\Stock;
use App\Services\QuoteService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function __construct(public readonly QuoteService $quoteService)
    {
    }

    public function index()
    {
        $stock = Stock::all();

        return view('search', compact("stock"));
    }

    public function storeQuote(StoreQuoteRequest $request): RedirectResponse
    {
        try {
            $payload = $request->validated();
            $this->quoteService->create($payload);
            return redirect()->route('home');
        } catch (BrazaApiException $exception) {
            return redirect()->route('home')->withErrors([
                'quote' => $exception->getMessage()
            ]);
        }
    }

    public function removeQuote(Request $req): RedirectResponse
    {
        $quote = $req->input('search-bar-quote');

        Stock::where('symbol', $quote)->delete();

        return redirect()->route('home');
    }
}
