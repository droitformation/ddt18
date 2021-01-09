<?php namespace App\Droit\Api;

trait FetchData
{
    public function toUpdate()
    {
        $current  = $this->helper->getMaj($this->file);
        $response = $this->client->get($this->base_url.'/maj');

        if($response->getStatusCode() == 503){
            \Log::info('is down don\'t update');
            return null;
        }
        
        \Cache::flush();
        $this->toUpdate = true;
        
        return true;

        $last = $this->process($response,$current);

        if($last != $current){

            \Log::info('last '.$last);
            \Log::info('current '.$current);

            \Log::info('flushed');
            \Cache::flush();
            $this->toUpdate = true;
        }
    }

    public function process($response)
    {
        $last = \Carbon\Carbon::today()->toDateString();

        // response from server
        if($response->getStatusCode() == 200){
            $data = json_decode($response->getBody(), true);
            $last = isset($data['date']) ? $data['date'] : \Carbon\Carbon::today()->toDateString();

            $this->helper->setMaj($last,$this->file);
        }

        return $last;
    }

    public function getData($url, $params = null){

        $action = $params ? 'post' : 'get';

        try {
            $response = $this->client->$action($this->base_url.'/'.$url, ['query' => $params]);
            $data     = json_decode($response->getBody(), true);

            return $this->prepareData($data);
        }
        catch (GuzzleException $error) {}

        return collect([]);
    }

}