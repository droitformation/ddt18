<?php namespace App\Droit\Api;

trait FetchData
{
    public function toUpdate()
    {
        $current  = $this->helper->getMaj($this->file);
        $response = $this->client->get($this->base_url.'/maj');

        $last = $this->process($response,$current);

        // can't return true after cache flush -_.._-
        if($last != $current){
            \Cache::flush();
        }

        return $last != $current ? true : false;
    }

    public function process($response)
    {
        $last = \Carbon\Carbon::today()->toDateString();

        // response from server
        if($response->getStatusCode() == 200){
            $data = json_decode($response->getBody(), true);
            $last = isset($data['date']) ? $data['date'] : \Carbon\Carbon::today()->toDateString();

            $this->helper->setMaj($last,'hub');
        }

        return $last;
    }

    public function getData($url, $params = null){

        $action = $params ? 'post' : 'get';

        try {
            $response = $this->client->$action($this->base_url.'/'.$url, ['query' => $params]);
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

}