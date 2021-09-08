<?php

namespace App\Services\Postcode;

use Illuminate\Support\Facades\Http;

class Postcode
{
    private $baseUrl = 'https://postcodes.io';

    public function lookup($postcode)
    {
        $response = Http::get("{$this->baseUrl}/postcodes/{$postcode}");

        if ($response->clientError()) {
            return false;
        }

        return $response->json();
    }
}
