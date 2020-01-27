<?php namespace App\Droit\Api;

use App\Droit\Api\FetchData;

class Content
{
    use FetchData;

    public $site;
    public $file = 'colloque';
    protected $client;
    protected $base_url;
    protected $helper;

    public $toUpdate = false;

    public function __construct($site,$client = null)
    {
        $this->site = $site;
        $this->helper = new \App\Droit\Helper\Helper();
        $this->client = $client ? $client : new \GuzzleHttp\Client(['verify' => false, 'http_errors' => false]); // ,'debug' => true

        $this->base_url = (\App::environment() == 'local' ? 'https://shop.test/hub' : 'https://www.publications-droit.ch/hub');

        $this->toUpdate();
    }

    public function prepareData($data)
    {
        if(!empty($data) && isset($data['data'])){
            return json_decode(json_encode($data['data']));
        }

        return null;
    }

    public function homepage()
    {
        $params = ['params' => ['site_id' => $this->site]];
        $params = array_filter($params);

        return \Cache::rememberForever('homepage', function () use ($params) {
            return $this->getData('homepage', $params);
        });
    }

    public function page($id)
    {
        $params = ['params' => ['id' => $id]];
        $params = array_filter($params);

        return \Cache::rememberForever('page_'.$id, function () use ($params,$id) {
            return $this->getData('page', $params);
        });
    }

    public function menu($position)
    {
        $params = ['params' => ['site_id' => $this->site, 'position' => $position]];
        $params = array_filter($params);

        return \Cache::rememberForever('menu', function () use ($params) {
            return $this->getData('menu', $params);
        });
    }

    public function pdf($id)
    {
        $params = ['params' => ['site_id' => $this->site, 'id' => $id]];
        $params = array_filter($params);

        return $this->getData('pdf', $params);
    }
}