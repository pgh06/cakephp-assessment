<?php
declare(strict_types=1);

namespace App\Test\TestCase\Service;

use Cake\Http\Client;
use Cake\Http\Client\Response;
use Cake\TestSuite\TestCase;
use App\Service\TmdbService;

class TmdbServiceTest extends TestCase
{
    public function testSearchPersonReturnsResults(): void
    {
        $mock = $this->createMock(Client::class);
        $mockResponse = $this->createMock(Response::class);

        $mockResponse->method('isOk')->willReturn(true);
        $mockResponse->method('getJson')->willReturn(['results' => [['id' => 123, 'name' => 'Test Actor']]]);

        $mock->method('get')->willReturn($mockResponse);

        $service = new TmdbService($mock);
        $results = $service->searchPerson('Test', 'https://api.test', 'fake-key');

        $this->assertNotEmpty($results);
        $this->assertEquals('Test Actor', $results[0]['name']);
    }
}
