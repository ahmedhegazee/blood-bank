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
function notifyByFireBase($title, $body, $tokens, $data)
{

    $fcmMessage = [
        'body' => $body,
        'title' => $title,
        'sound' => 'default',
        'color' => '#203E78'
    ];
    $fcmFileds = [
        'registration_ids' => $tokens,
        // 'to' => $tokens,
        'priority' => 'high',
        'notification' => $fcmMessage,
        'data' => $data,
    ];
    $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
    $headers = [
        'Authorization: key=' . env('FCM_SERVER_KEY'),
        'Content-Type: application/json'
    ];


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $fcmUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFileds));
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
