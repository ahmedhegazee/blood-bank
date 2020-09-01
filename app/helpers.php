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
function getHerokuDatabaseData($url)
{
    //heroku pgsql database guide
    //https://medium.com/@juangsalazprabowo/how-to-deploy-a-laravel-app-into-heroku-df55efbf8e4e
    //path is database name
    //add the config in the settings of app and don't change your database config file
    $DATABASE_URL = parse_url($url);
    $DATABASE_URL = array_merge($DATABASE_URL, ['path' => ltrim($DATABASE_URL['path'], '/')]);
    $dbName = $DATABASE_URL['path'];
    array_pop($DATABASE_URL);
    $DATABASE_URL['db_name'] = $dbName;
    return $DATABASE_URL;
}
function sendSMSByMisrSMS($to, $message)
{
    $url = 'https://smsmisr.com/api/webapi/?';
    $push_payload = array(
        "username" => "*****",
        "password" => "*****",
        "language" => "2",
        "sender" => "ipda3",
        "mobile" => '2' . $to,
        "message" => $message,
    );

    $rest = curl_init();
    curl_setopt($rest, CURLOPT_URL, $url . http_build_query($push_payload));
    curl_setopt($rest, CURLOPT_POST, 1);
    curl_setopt($rest, CURLOPT_POSTFIELDS, $push_payload);
    curl_setopt($rest, CURLOPT_SSL_VERIFYPEER, true);  //disable ssl .. never do it online
    curl_setopt(
        $rest,
        CURLOPT_HTTPHEADER,
        array(
            "Content-Type" => "application/x-www-form-urlencoded"
        )
    );
    curl_setopt($rest, CURLOPT_RETURNTRANSFER, 1); //by ibnfarouk to stop outputting result.
    $response = curl_exec($rest);
    curl_close($rest);
    return $response;
}