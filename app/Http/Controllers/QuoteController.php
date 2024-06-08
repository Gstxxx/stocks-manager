<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Expr\Cast\String_;
use Illuminate\Support\Facades\View;

class QuoteController extends Controller
{
    public function index()
    {
        $stock = Stock::all();

        return view('search', compact("stock"));
    }
    public function storeQuote(Request $req): RedirectResponse
    {
        $quote = $req->input('search-bar-quote');
        $amount = $req->input('amount-quote');
        $paid = $req->input('paid-quote');

        $token = env('BR_API_TOKEN');
        $response = Http::get("https://brapi.dev/api/quote/{$quote}?token={$token}");

        if (!$response->successful()) {
            return "nao foi possivel dessa vez amigao";
        }

        Stock::updateOrCreate(['symbol' => $response->json('results.0.symbol')], [
            'longName' => $response->json('results.0.longName'),
            'logourl' => $response->json('results.0.logourl'),
            'regularMarketChange' => $response->json('results.0.regularMarketChange'),
            'regularMarketChangePercent' => $response->json('results.0.regularMarketChangePercent'),
            'regularMarketTime' => $response->json('results.0.regularMarketTime'),
            'regularMarketPrice' => $response->json('results.0.regularMarketPrice'),
            'regularMarketPreviousClose' => $response->json('results.0.regularMarketPreviousClose'),
            'regularMarketOpen' => $response->json('results.0.regularMarketOpen'),
            'amount' => $amount,
            'paid' => $paid,
        ]);

        return redirect()->route('home');
    }

    public function removeQuote(Request $req): RedirectResponse
    {
        $quote = $req->input('search-bar-quote');

        Stock::where('symbol', $quote)->delete();

        return redirect()->route('home');
    }
}
