<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\FakeGuzzleClientResponses;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

class JurisprudenceTest extends TestCase
{
    public function testJurisprudenceHasToUpdate500Error()
    {
        $mock = new MockHandler([
            new Response(500, ['X-Foo' => 'Bar'],'Hello, World'),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $jurisprudence = new \App\Droit\Api\Jurisprudence(5,$client);

        $this->assertFalse($jurisprudence->toUpdate());
    }

    public function testJurisprudenceHasToUpdateYes()
    {
        config(['maj.hub' => \Carbon\Carbon::today()->subDays(5)->toDateString()]);

        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'],json_encode(['date' => \Carbon\Carbon::today()->toDateString()])),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $jurisprudence = new \App\Droit\Api\Jurisprudence(5,$client);

        $this->assertTrue($jurisprudence->toUpdate());
    }

    public function testJurisprudenceHasToUpdateNo()
    {
        config(['maj.hub' => \Carbon\Carbon::today()->toDateString()]);

        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'],json_encode(['date' => \Carbon\Carbon::today()->toDateString()])),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $jurisprudence = new \App\Droit\Api\Jurisprudence(5,$client);

        $this->assertFalse($jurisprudence->toUpdate());
    }
}
