<?php
declare(strict_types=1);

namespace App\Factory;

use App\Service\TmdbService;
use Cake\Http\Client;

class TmdbServiceFactory
{
    /**
     * Initialize tmdb service and client
     *
     * @return TmdbService
     */
    public static function create(): TmdbService
    {
        return new TmdbService(new Client());
    }
}
