<?php namespace App\Droit\Api;

use App\Droit\Api\FetchData;

class Jurisprudence
{
    use FetchData;

    public $site;
    public $file = 'hub';
    protected $client;
    protected $base_url;
    protected $helper;

    public $toUpdate = false;

    public function __construct($site, $client = null)
    {
        $this->site = $site;
        $this->helper = new \App\Droit\Helper\Helper();
        $this->client = $client ? $client : new \GuzzleHttp\Client(['verify' => false, 'http_errors' => false]);

        $this->base_url = (\App::environment() == 'local' ? 'https://shop.test/hub' : 'https://www.publications-droit.ch/hub');

        $this->toUpdate();
    }

    public function prepareData($data)
    {
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

        return \Cache::rememberForever('arrets', function () use ($params) {
            return $this->getData('arrets', $params);
        });
    }

    public function analyses($data = [])
    {
        $params = ['params' => ['site_id' => $this->site] + $data];
        $params = array_filter($params);

        return \Cache::rememberForever('analyses', function () use ($params) {
            return $this->getData('analyses', $params);
        });
    }

    public function years()
    {
        $params = ['params' => ['site_id' => $this->site]];

        return \Cache::rememberForever('years', function () use ($params) {
            return $this->getData('years', $params);
        });
    }

    public function categories()
    {
        $params = ['params' => ['site_id' => $this->site]];

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
        $params = ['params' => ['site_id' => $this->site, 'id' => $id]];

        return \Cache::rememberForever('campagne', function () use ($params) {
            $campagne = $this->getData('campagne', $params);
            return $campagne->all();
        });
    }

    public function archives($year = null)
    {
        $params = ['params' => ['site_id' => $this->site, 'year' => $year]];

        return \Cache::rememberForever('archives', function () use ($params) {
            return $this->getData('archives', $params);
        });
    }
}