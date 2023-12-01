<?php

namespace App\Http\Controllers;

use App\Models\ZoomAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ZoomAuthController extends Controller
{
    protected $accountId;
    protected $clientId;
    protected $clientSecret;
    protected $secretToken;
    private $accessToken;
    protected $refreshToken;

    protected $pathV2;
    protected $pathGlobal;

    public function __construct() {
        $this->accountId = env("ZOOM_ACCOUNT_ID");
        $this->clientId = env("ZOOM_CLIENT_ID");
        $this->clientSecret = env("ZOOM_CLIENT_SECRET");

        $this->accessToken;
        $this->refreshToken;
        $this->secretToken = env("ZOOM_SECRET_TOKEN");
        $this->pathV2 = env("ZOOM_PATH_V2");
        $this->pathGlobal = env("ZOOM_PATH_GLOBAL");
    }


    public function createAccessToken(){

        $zoomCredencials = new ZoomAuthController();

        $endPoint = "oauth/token";
        $url = $zoomCredencials->pathGlobal.$endPoint;

        
        $headers = [
            "Content-Type" => "application/x-www-form-urlencoded",
            "Authorization" => "Basic ". base64_encode($zoomCredencials->clientId.":".$zoomCredencials->clientSecret)
        ];

        $params = [
            "grant_type" => "account_credentials",
            "account_id" => $zoomCredencials->accountId
        ];


        $response = Http::asForm()->withHeaders($headers)->post($url, $params);

        $access_token = $response['access_token'];

        DB::beginTransaction();
        ZoomAuth::updateOrCreate(
            ['account_id' => $zoomCredencials->accountId],
            [
                'account_id' => $zoomCredencials->accountId,
                'client_id' => $zoomCredencials->clientId,
                'client_secret' => $zoomCredencials->clientSecret,
                'secret_token' => $zoomCredencials->secretToken,
                'access_token' => $access_token
            ]
        );
        DB::commit();

        



        dd($access_token);
        


    }


}
