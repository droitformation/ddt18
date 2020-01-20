<?php namespace Tests;

trait FakeGuzzleClientResponses
{
    public $mockHandler;

    public function setupTestGuzzleClient()
    {
        $this->mockHandler = new MockHandler;
        $handler = HandlerStack::create($this->mockHandler);
        $client = new Client(['handler' => $handler]);

        $this->app->instance(GuzzleHttp\Client::class, $client);
    }

    public function appendToHandler($statusCode = 200, $headers = [], $body = '', $version = '1.1', $reason = null)
    {
        if (! $this->mockHandler) {
            $this->setupTestGuzzleClient();
        }

        $this->mockHandler->append(new Response($statusCode, $headers, $body, $version, $reason));
    }

    public function fakeGuzzleInvalidClientIdResponse()
    {
        $this->appendToHandler(500, [], []);
    }
}