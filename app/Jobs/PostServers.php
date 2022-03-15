<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use GuzzleHttp\Client;

class PostServers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $retorno;
    public function __construct($retorno =  null)
    {
        $this->retorno = $retorno;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = new Client();
        $servers = config('servers');
        $values = array_values($this->retorno);
        foreach($servers as $url => $server){
            foreach($server as $index => $b){
                $orderServer[$b] = $values[$index];
            }
            $body = ['headers'   =>
                        [
                            'Accept'        => 'application/json',
                            'Content-type'  => 'application/json; charset=UTF-8'
                        ],  'body' => json_encode($orderServer)
            ];

            $res  = $client->request('POST', $url, $body );
            $res2 = json_decode($res->getBody());
            $orderServer = [];
        }
    }
}
