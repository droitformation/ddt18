<?php namespace App\Droit\Api;

class Jurisprudence
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
            $collection = new \Illuminate\Support\Collection($data['data']);

            return $collection->map(function ($item, $key) {
                return json_decode(json_encode($item));
            });
        }

        return collect([]);
    }

    public function arrets($data = [])
    {
        $params = ['params' => ['site_id' => $this->site] + $data];
        $params = array_filter($params);

        return $this->getData('arrets', $params);
    }

    public function analyses($data = [])
    {
        $params = ['params' => ['site_id' => $this->site] + $data];
        $params = array_filter($params);

        return $this->getData('analyses', $params);
    }

    public function years()
    {
        return $this->getData('years', ['params' => ['site_id' => $this->site]]);
    }

    public function categories()
    {
        $data = $this->getData('categories', ['params' => ['site_id' => $this->site]]);

        return [collect($data['categories']),collect($data['parents'])];
    }

    public function authors()
    {
        return $this->getData('authors', ['params' => ['site_id' => $this->site]]);
    }

    public function campagne($id = null)
    {
        $campagne = $this->getData('campagne', ['params' => ['site_id' => $this->site, 'id' => $id]]);

        return $campagne->all();
    }

    public function archives()
    {
        return $this->getData('archives', ['params' => ['site_id' => $this->site]]);
    }
}