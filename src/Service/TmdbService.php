<?php
declare(strict_types=1);

namespace App\Service;

use Cake\Http\Client;

class TmdbService
{
    protected Client $http;

    /**
     * Constructor.
     *
     * @param \Cake\Http\Client|null $http Optional HTTP client instance. If none provided, a new Client will be created.
     */
    public function __construct(?Client $http = null)
    {
        $this->http = $http ?? new Client();
    }

    /**
     * Search persons via TMDB API.
     *
     * @param string $term Search term
     * @param string $url API URL
     * @param string $apiKey API key
     * @return array<array<string, mixed>> List of search results as arrays
     */
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
