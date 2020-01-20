<?php namespace App\Droit\Api;

use GuzzleHttp\Exception\GuzzleException;

class Content
{
    public $site;
    protected $client;
    protected $base_url;
    protected $helper;

    public function __construct($site)
    {
        $this->site = $site;

        $this->client  = new \GuzzleHttp\Client([ 'verify' => false ,'http_errors' => false]);
        $this->helper = new \App\Droit\Helper\Helper();

        $environment = app()->environment();
        $this->base_url = ($environment == 'local' ? 'https://shop.test/hub' : 'https://www.publications-droit.ch/hub');

        $this->toUpdate();
    }

    public function getData($url, $params = null){

        $action = $params ? 'post' : 'get';

        try {
            $response = $this->client->$action( $this->base_url.'/'.$url, ['query' => $params]);
            $data     = json_decode($response->getBody(), true);

            if(!empty($data) && isset($data['data'])){
                return json_decode(json_encode($data['data']));
            }
        }
        catch (GuzzleException $error) {}

        return null;
    }

    public function toUpdate()
    {
        $current  = $this->helper->getMaj('colloque');
        $response = $this->client->get($this->base_url.'/maj',['http_errors' => false]);

        // response from server
        if($response->getStatusCode() == 200){
            $data = json_decode($response->getBody(), true);
            $last = isset($data['date']) ? $data['date'] : \Carbon\Carbon::today()->toDateString();

            if($last == $current){
                return false;
            }else{
                \Cache::flush();

                $this->helper->setMaj($last,'colloque');
                \Illuminate\Support\Facades\Artisan::call('cache:clear');
            }
        }

        // no response from server get cached items
        return false;
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
        $params = ['params' => ['site_id' => $this->site, 'id' => $id]];
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