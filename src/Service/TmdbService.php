<?php
declare(strict_types=1);

namespace App\Service;

use Cake\Http\Client;

class TmdbService
{
    protected Client $http;

    public function __construct(?Client $http = null)
    {
        $this->http = $http ?? new Client();
    }

    public function searchPerson(string $term, string $url, string $apiKey): array
    {
        $response = $this->http->get($url, [
            'api_key' => $apiKey,
            'query' => $term,
            'language' => 'en-US',
            'include_adult' => 'false',
        ]);

        if ($response->isOk()) {
            $data = $response->getJson();
            return $data['results'] ?? [];
        }

        return [];
    }
}
