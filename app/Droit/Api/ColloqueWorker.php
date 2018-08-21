<?php namespace App\Droit\Api;

class ColloqueWorker{

    protected $custom;
    protected $client;

    /* Inject dependencies */
    public function __construct()
    {
        $this->custom  = new \App\Droit\Helper\Helper();
        $this->client  = new \GuzzleHttp\Client(['curl' => [CURLOPT_SSL_VERIFYPEER => false]]);

        $environment    = \App::environment();
        $this->base_url = ($environment == 'local' ? 'https://shop.local' : 'https://www.publications-droit.ch');
    }

    public function getColloques(){

        $response   = $this->client->get( $this->base_url.'/event', ['query' => ['centres' => ['3','2'] ]]);
        
        $data       = json_decode($response->getBody(), true);
        $data       = $this->organise($data['data']);

        $collection = collect($data);

        return $collection;
    }

    public function getArchives(){

        $response   = $this->client->get( $this->base_url.'/event', ['query' => ['archive' => 'archive', 'centres' => ['2','3'] ]]);
        $data       = json_decode($response->getBody(), true);
        $data       = $this->organiseYear($data['data']);
        $collection = collect($data);

        return $collection;
    }

    public function organise($data){

        if(!empty($data))
        {
            foreach($data as $colloque)
            {
                $organisateurs = $colloque['organisateur'];
                $organisateurs = array_values($organisateurs);

                $centre = (count($organisateurs) > 1 ? 'both' : $organisateurs[0]);
                $organise[$centre][] = $colloque;
            }

            $sorting  = ['cert','cemaj'];
            $organise = $this->custom->sortArrayByArray($organise,$sorting);

            return $organise;
        }

        return [];
    }

    public function organiseYear($data){

        if(!empty($data))
        {
            foreach($data as $colloque)
            {
                $date = $colloque['event']['start_at'];
                $year = \Carbon\Carbon::parse($date);
                $years[$year->year][] = $colloque;
            }

            ksort($years);

            foreach($years as $year => $event)
            {
                $organise[$year] = $this->organise($event);
            }

            krsort($organise);

            return $organise;
        }

        return [];
    }
}