<?php

namespace App\Http\Controllers;

use App\Models\ZoomAuth;
use Gos\Component\WebSocketClient\Wamp\ClientFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use WSSC\Components\ClientConfig;
use WSSC\WebSocketClient;

class ZoomWebhookController extends Controller
{

    private $subscribeId;
    private $access_token;


    public function __construct()
    {
        $token = ZoomAuth::orderBy('id', 'DESC')->first();

        $this->access_token = $token->access_token;
        $this->subscribeId = env('ZOOM_SUBSCRIBE_ID');
    }



    public function receiverWebhookZoom(Request $request){
        

        $config = new ClientConfig();

        $config->setTimeout(30);
        $config->setHeaders([
            'X-Custom-Header' => 'Foo Bar Baz',
        ]);

        $url = 'wss://ws.zoom.us/ws?subscriptionId='.$this->subscribeId.'&access_token='.$this->access_token.'&module=heartbeat';

        $client = new WebSocketClient($url, $config);
        $client->send('{"module": "heartbeat"}');
        
        Log::info($request->all());

        dd($client->receive());

        


    }
}
