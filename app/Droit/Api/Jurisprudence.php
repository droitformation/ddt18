<?php namespace App\Droit\Api;

use GuzzleHttp\Exception\GuzzleException;

class Jurisprudence
{
    public $site;
    protected $client;
    protected $base_url;
    protected $helper;

    public function __construct($site, $client = null)
    {
        $this->site = $site;
        $this->helper = new \App\Droit\Helper\Helper();
        $this->client = $client ? $client : new \GuzzleHttp\Client(['verify' => false, 'http_errors' => false]);

        $environment = app()->environment();
        $this->base_url = ($environment == 'local' ? 'https://shop.test/hub' : 'https://www.publications-droit.ch/hub');

        $this->toUpdate();
    }

    public function toUpdate()
    {
        $current  = $this->helper->getMaj('hub');
        $response = $this->client->get($this->base_url.'/maj',['http_errors' => false]);

        // response from server
        if($response->getStatusCode() == 200){
            $data = json_decode($response->getBody(), true);
            $last = isset($data['date']) ? $data['date'] : \Carbon\Carbon::today()->toDateString();

            if($last == $current){
                return false;
            }else{
                \Cache::flush();
                $this->helper->setMaj($last,'hub');
            }
        }

        // no response from server get cached items
        return false;
    }

    public function getData($url, $params = null){

        $action = $params ? 'post' : 'get';

        try {
            $response = $this->client->$action($this->base_url.'/'.$url, ['query' => $params, 'http_errors' => false]);
            $data     = json_decode($response->getBody(), true);

            if(!empty($data) && isset($data['data'])){
                $collection = new \Illuminate\Support\Collection($data['data']);
                return $collection->map(function ($item, $key) {
                    return json_decode(json_encode($item));
                });
            }
        }
        catch (GuzzleException $error) {}

        return collect([]);
    }

    public function arrets($data = [])
    {
        $params = ['http_errors' => false, 'params' => ['site_id' => $this->site] + $data];
        $params = array_filter($params);

        return \Cache::rememberForever('arrets', function () use ($params) {
            return $this->getData('arrets', $params);
        });
    }

    public function analyses($data = [])
    {
        $params = ['http_errors' => false, 'params' => ['site_id' => $this->site] + $data];
        $params = array_filter($params);

        return \Cache::rememberForever('analyses', function () use ($params) {
            return $this->getData('analyses', $params);
        });
    }

    public function years()
    {
        $params = ['http_errors' => false, 'params' => ['site_id' => $this->site]];

        return \Cache::rememberForever('years', function () use ($params) {
            return $this->getData('years', $params);
        });
    }

    public function categories()
    {
        $params = ['http_errors' => false, 'params' => ['site_id' => $this->site]];

        return \Cache::rememberForever('categories', function () use ($params) {
            $data = $this->getData('categories', $params);

            return [collect($data['categories']),collect($data['parents'])];
        });
    }

    public function authors()
    {
        $params = ['params' => ['site_id' => $this->site]];

        return \Cache::rememberForever('authors', function () use ($params) {
            return $this->getData('authors', $params);
        });
    }

    public function campagne($id = null)
    {
        $params = ['http_errors' => false, 'params' => ['site_id' => $this->site, 'id' => $id]];

        return \Cache::rememberForever('campagne', function () use ($params) {
            $campagne = $this->getData('campagne', $params);
            return $campagne->all();
        });
    }

    public function archives($year = null)
    {
        $params = ['http_errors' => false, 'params' => ['site_id' => $this->site, 'year' => $year]];

        return \Cache::rememberForever('archives', function () use ($params) {
            return $this->getData('archives', $params);
        });
    }
}