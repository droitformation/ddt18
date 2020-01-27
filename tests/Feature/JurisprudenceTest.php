<?php

namespace Tests\Feature;

use Tests\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class JurisprudenceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function tearDown(): void
    {
        \Mockery::close();
        parent::tearDown();
    }

    public function testJurisprudenceHasToUpdate500Error()
    {
        $helper = new \App\Droit\Helper\Helper();

        $mock = $this->mock(Client::class);
        $mock->shouldReceive('get')->andReturn(new Response(500, [], 'Hello World'));

        $jurisprudence = new \App\Droit\Api\Jurisprudence(4,$mock);
        $jurisprudence->toUpdate();

        $this->assertFalse($jurisprudence->toUpdate);
    }

   public function testJurisprudenceHasToUpdateYes()
    {
        $helper = new \App\Droit\Helper\Helper();
        $helper->setMaj(\Carbon\Carbon::today()->toDateString(),'hub');

        \Cache::shouldReceive('flush')->andReturn(true);

        $mock = $this->mock(\GuzzleHttp\Client::class);
        $mock->shouldReceive('get')->andReturn(
            new Response(200,[], json_encode(['date' => \Carbon\Carbon::today()->subDays(4)->toDateString()]))
        );

        $jurisprudence = new \App\Droit\Api\Jurisprudence(4,$mock);

        $jurisprudence->toUpdate();

        $this->assertTrue($jurisprudence->toUpdate);
    }

    public function testJurisprudenceHasToUpdateNo()
    {
        $helper = new \App\Droit\Helper\Helper();
        $helper->setMaj(\Carbon\Carbon::today()->toDateString(),'hub');

        $mock = $this->mock(\GuzzleHttp\Client::class);
        $mock->shouldReceive('get')->andReturn(
            new Response(200,[], json_encode(['date' => \Carbon\Carbon::today()->toDateString()]))
        );

        $jurisprudence = new \App\Droit\Api\Jurisprudence(4,$mock);
        $jurisprudence->toUpdate();

        $this->assertFalse($jurisprudence->toUpdate);
    }
}
