<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuoteRequest extends FormRequest
{


    public function rules(): array
    {
        return [
            'search-bar-quote' => ['required', 'string'],
            'amount-quote' => ['required', 'numeric'],
            'paid-quote' => ['required', 'numeric'],
        ];
    }
}
