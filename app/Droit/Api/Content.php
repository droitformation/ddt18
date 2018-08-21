<?php namespace App\Droit\Api;

class Content
{
    public $site;
    protected $client;
    protected $base_url;

    public function __construct($site)
    {
        $this->site = $site;

        $this->client  = new \GuzzleHttp\Client([ 'verify' => false ]);

        $environment = app()->environment();
        $this->base_url = ($environment == 'local' ? 'http://dpapi.local/api' : 'https://www.publications-droit.ch');
    }

    public function getData($url, $params = null){

        $action = $params ? 'post' : 'get';

        $response = $this->client->$action( $this->base_url.'/'.$url, ['query' => $params]);
        $data     = json_decode($response->getBody(), true);

        if(!empty($data) && isset($data['data'])){
            return json_decode(json_encode($data['data']));
        }

        return null;
    }

    public function homepage()
    {
        $params = ['params' => ['site_id' => $this->site]];
        $params = array_filter($params);

        return $this->getData('homepage', $params);
    }

    public function page($id)
    {
        $params = ['params' => ['site_id' => $this->site, 'id' => $id]];
        $params = array_filter($params);

        return $this->getData('page', $params);
    }

    public function menu($position)
    {
        $params = ['params' => ['site_id' => $this->site, 'position' => $position]];
        $params = array_filter($params);

        return $this->getData('menu', $params);
    }

}