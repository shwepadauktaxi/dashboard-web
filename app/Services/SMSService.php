<?php

namespace App\Services;

use GuzzleHttp\Client;

class SMSService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = config('smspost.api_key');
    }

    public function sendOTP($phoneNumber, $otp, $senderName = 'SMSPoh')
    {
        $response = $this->client->post('https://smspoh.com/api/v2/send', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'to' => $phoneNumber,
                'message' => "OTP code for ".env('APP_NAME')." is $otp",
                'sender' => $senderName,
            ]
        ]);

        return $response->getStatusCode() === 200;
    }
}
