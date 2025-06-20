<?php
declare(strict_types=1);

namespace App\Factory;

use App\Service\TmdbService;
use Cake\Http\Client;

class TmdbServiceFactory
{
    public static function create(): TmdbService
    {
        $client = new Client();
        return new TmdbService($client);
    }
}