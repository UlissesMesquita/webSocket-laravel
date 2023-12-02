<?php

namespace App\Http\Controllers;

use App\Models\ZoomAuth;
use WSSC\WebSocketClient;
use \WSSC\Components\ClientConfig;

use Illuminate\Http\Request;

class ZoomWebSocketController extends Controller
{

    private $subscribeId;
    private $access_token;


    public function __construct()
    {
        $token = ZoomAuth::orderBy('id', 'DESC')->first();

        $this->access_token = $token->access_token;
        $this->subscribeId = env('ZOOM_SUBSCRIBE_ID');
    }



    public function authWebsocketConfig(){

        //Consome Websocket Zoom
        $url = 'wss://ws.zoom.us/ws?subscriptionId='.$this->subscribeId.'&access_token='.$this->access_token;

        $client = new WebSocketClient($url, new ClientConfig());

        // while (true) {
            $payload = json_encode(
                ['module' => 'heartbeat']
            );
            $client->send($payload, 'text');
            echo $client->receive();
            // sleep(30); // Pausa a execução por 30 segundos
        // }
   






        


    }
}
