<?php

use Twilio\Rest\Client as RestClient;

// we add this file in the composer file 
// add this section in the autoload section 
/*
  "files": [
            "App/helpers.php"
        ],
 */
// to allow the class be defined in the loading of the application
function jsonResponse($status, $message, $data = null, $responseStatus = 200)
{
    $response = [
        'status' => $status,
        'message' => $message,
        'data' => $data
    ];
    return response()->json($response, $responseStatus, [], JSON_UNESCAPED_UNICODE);
}
function sendSMS($message, $recipients)
{
    $account_sid = getenv("TWILIO_SID");
    $auth_token = getenv("TWILIO_AUTH_TOKEN");
    $twilio_number = getenv("TWILIO_NUMBER");
    $client = new RestClient($account_sid, $auth_token);
    $client->messages->create(
        $recipients,
        ['from' => $twilio_number, 'body' => $message]
    );
}
