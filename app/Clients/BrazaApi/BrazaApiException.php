<?php

namespace App\Clients\BrazaApi;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class BrazaApiException extends Exception
{
    public static function quoteNotFound(string $quote): self
    {
        $message = sprintf('Quote %s not found, please try again', $quote);
        return new self($message, Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
